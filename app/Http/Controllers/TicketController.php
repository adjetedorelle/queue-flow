<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendRappelJob;
use App\Models\Admin;
use App\Models\Agence;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\FileAttente;
use App\Models\Personnel;
use App\Models\Service;
use App\Models\Ticket;
use App\Notifications\RebalancementTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;

class TicketController extends Controller
{

    public function ticketsdispo(Request $request)
    {
        $user_connectee = auth()->user();
        $filtre = $request->query('filtre', 'tous'); // 'tous', 'aujourd_hui', 'prioritaires'

        // Base query selon le rôle
        if ($user_connectee->role === 'super-admin') {
            $query = Ticket::query();
        }

        if ($user_connectee->role === 'personnel') {
            $personnel = Personnel::where('utilisateur_id', $user_connectee->id)->first();
            $services = Service::where('entreprise_id', $personnel->entreprise_id)->pluck('id');
            $query = Ticket::whereIn('service_id', $services);
            $ticketsResolus = Ticket::whereIn('service_id', $services)
                ->where('statut', 'traite')
                ->count();
        }

        if ($user_connectee->role === 'admin') {
            $admin = Admin::where('utilisateur_id', $user_connectee->id)->first();
            $entreprise = Entreprise::where('admin_id', $admin->id)->first();
            $services = Service::where('entreprise_id', $entreprise->id)->pluck('id');
            $query = Ticket::whereIn('service_id', $services);
            
        }

        // Application des filtres
        if ($filtre === 'aujourd_hui') {
            $query->whereDate('created_at', today());
        }

        if ($filtre === 'prioritaires') {
            $query->where('type', 'express')
            ->wheredate('created_at', today())
            ; // adapte selon ton champ
        }

        $tickets = $query->paginate(6);

        return view('tickets.tickets_dispo', compact('tickets', 'filtre'));
    }


    public function ticketsNonTraites($id_service)
    {
        $user_connectee = auth()->user();
        if ($user_connectee->role === 'personnel') {
            $personnel = Personnel::WHERE('utilisateur_id', '=', $user_connectee->id)->first();
            $ticket_encour = Ticket::WHERE('personnel_id', '=', $personnel->id)
                ->WHERE('statut', '=', 'en_cours')
                // use between to compare date collumn  jour de passage with today start date and today end date
                ->WHERE('jour_passage', '>=', today()->startOfDay())
                ->WHERE('jour_passage', '<=', today()->endOfDay())
                ->first();
        }

        $tickets = Ticket::WHERE('service_id', '=', $id_service)
            ->WHEREIN('statut', ['en_attente', 'en_cours'])
            ->get();
        $count = $tickets->count();

        return view('tickets.tickets_en_attente', compact('tickets', 'ticket_encour', 'count'));
    }

    public function formulaireDate($service_id = null)
    {
        $service = null;
        $entreprise = null;

        if ($service_id) {
            $service = Service::with('entreprise')->find($service_id);
            if (!$service) {
                return redirect()->route('services_disponibles')->with('error', 'Service non trouvé.');
            }
            $entreprise = $service->entreprise;
        }

        // Récupérer le client pour vérifier le statut VIP
        $user = auth()->user();
        $client = Client::where('utilisateur_id', $user->id)->first();
        $agences = Agence::where('entreprise_id', $service->entreprise_id)->get();
        return view('tickets.formulaire_date', compact('service', 'entreprise', 'client', 'agences'));
    }

    public function submitTicket(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'agence_id' => 'nullable|exists:agences,id',
            'jour_passage' => 'required|date|after:now',
            'rappel_minutes' => 'nullable|integer|min:1|max:60',
            'type_ticket' => 'required|in:standard,vip',
            'motif' => 'required_if:type_ticket,vip|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Récupérer ou créer le client
            $user = auth()->user();
            $client = Client::where('utilisateur_id', $user->id)->first();
            if (!$client) {
                $client = Client::create([
                    'utilisateur_id' => $user->id,
                    'vip' => false
                ]);
            }

            // Vérifier le type de ticket demandé
            $typeTicket = $request->type_ticket;
            if ($typeTicket === 'vip' && !$client->vip) {
                
                return redirect()->back()->with('error', 'Seuls les clients VIP peuvent prendre des tickets VIP')->withInput();
            }

            // Récupérer le service
            $service = Service::find($request->service_id);
            
            // Vérifier si l'entreprise a des agences
            $agences = Agence::where('entreprise_id', $service->entreprise_id)->get();
            $hasAgences = $agences->isNotEmpty();
            
            // Validation conditionnelle : si l'entreprise a des agences, une agence doit être sélectionnée
            if ($hasAgences && !$request->agence_id) {
                return redirect()->back()->with('error', 'Veuillez sélectionner une agence.')->withInput();
            }
            
            // Récupérer l'agence sélectionnée (null si l'entreprise n'a pas d'agences)
            $agence = null;
            if ($request->agence_id) {
                $agence = Agence::find($request->agence_id);
                if (!$agence || $agence->entreprise_id !== $service->entreprise_id) {
                    return redirect()->back()->with('error', 'Agence invalide.')->withInput();
                }
            }

            // Chercher ou créer la FileAttente pour ce service, cette agence (ou null), à la date donnée et type
            $datePassage = Carbon::parse($request->jour_passage)->format('Y-m-d');
            $fileAttenteQuery = FileAttente::where('service_id', $service->id)
                ->where('date', $datePassage)
                ->where('type', $typeTicket)
                ->where('statut', 'ouverte');
                
            // Filtrer par agence seulement si une agence est spécifiée
            if ($agence) {
                $fileAttenteQuery->where('agence_id', $agence->id);
            } else {
                $fileAttenteQuery->whereNull('agence_id');
            }
            
            $fileAttente = $fileAttenteQuery->with('service')->first();

            if (!$fileAttente) {
                $fileAttente = FileAttente::create([
                    'date' => $datePassage,
                    'nb_client_restant' => 1,
                    'nb_total' => 1,
                    'statut' => 'ouverte',
                    'service_id' => $service->id,
                    'agence_id' => $agence ? $agence->id : null,
                    'type' => $typeTicket,
                ]);
            } else {
                $fileAttente->increment('nb_client_restant');
                $fileAttente->increment('nb_total');
            }

            // Générer un numéro de ticket unique
            $numero = $this->genererNumeroTicket($service->id, $request->jour_passage, $agence ? $agence->id : null);

            // Calculer l'heure exacte de passage
            $heureExact = $this->calculerHeureExacte($service, $request->jour_passage, $typeTicket, $agence ? $agence->id : null);

            // Vérifier que l'heure exacte est dans les horaires d'ouverture
            $entreprise = $service->entreprise;
            if (!$this->verifierHorairesOuverture($heureExact, $entreprise)) {

                return redirect()->back()->with('error', "L'heure de passage est en dehors des horaires d'ouverture de l'entreprise ({$entreprise->heure_ouv} - {$entreprise->heure_ferm}).")->withInput();
            }

            // Créer le ticket
            $ticket = Ticket::create([
                'numero' => $numero,
                'type' => $typeTicket,
                'jour_passage' => $request->jour_passage,
                'heure_exact' => $heureExact,
                'statut' => 'en_attente',
                'rappel_minutes' => $request->rappel_minutes,
                'client_id' => $client->id,
                'service_id' => $service->id,
                'file_attente_id' => $fileAttente->id,
                'agence_id' => $agence ? $agence->id : null,
                'motif' => $typeTicket === 'vip' ? $request->motif : null,
            ]);

            // Dispatcher le job de rappel si rappel_minutes est fourni
            if ($request->rappel_minutes) {
                $jourPassageCarbon = Carbon::parse($request->jour_passage);
                $rappelAt = $jourPassageCarbon->subMinutes($request->rappel_minutes);
                Log::info('Rappel à: ' . $rappelAt->format('Y-m-d H:i:s'));
                $delay = now()->diffInSeconds($rappelAt, false);
                Log::info('Delay: ' . $delay);

                if ($delay > 0) {
                    Log::info('Dispatching job with delay: ' . $delay);
                    SendRappelJob::dispatch($ticket)->delay($delay);
                } else {
                    // Si le rappel doit être envoyé maintenant
                    Log::info('Dispatching job immediately');
                    SendRappelJob::dispatch($ticket);
                }
            }

            DB::commit();

            return redirect()->route('page_ticket', ['ticketId' => $ticket->id])->with('success', 'Ticket créé avec succès !');
        } catch (\Throwable $th) {
            DB::rollback();
            
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création du ticket')->withInput();
        }
    }

    private function genererNumeroTicket($serviceId, $date, $agenceId)
    {
        // Format: année-mois-agence_id-service_id-numéro_séquentiel (ou année-mois-service_id-numéro_séquentiel si pas d'agence)
        $anneeMois = date('Y-m', strtotime($date));
        
        $query = Ticket::where('service_id', $serviceId)
            ->where('jour_passage', 'like', $anneeMois . '%');
            
        // Filtrer par agence seulement si une agence est spécifiée
        if ($agenceId) {
            $query->where('agence_id', $agenceId);
        } else {
            $query->whereNull('agence_id');
        }
        
        $dernierTicket = $query->orderBy('id', 'desc')->first();

        if ($dernierTicket) {
            // Extraire le numéro séquentiel du dernier ticket
            $parts = explode('-', $dernierTicket->numero);
            $dernierNumero = end($parts);
            $nouveauNumero = str_pad((int)$dernierNumero + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nouveauNumero = '001';
        }

        if ($agenceId) {
            return $anneeMois . '-' . $agenceId . '-' . $serviceId . '-' . $nouveauNumero;
        } else {
            return $anneeMois . '-' . $serviceId . '-' . $nouveauNumero;
        }
    }

    private function calculerHeureExacte($service, $jourPassage, $typeTicket, $agenceId)
    {
        $start = Carbon::parse($jourPassage);
        $dureeTotale = $service->temps_estime + 2; // Temps estimé + 2 min de marge

        // Récupérer tous les tickets planifiés pour ce service, cette agence (ou null), et ce jour, triés par heure de passage
        $query = Ticket::where('service_id', $service->id)
            ->whereDate('jour_passage', $start->toDateString())
            ->where('type', $typeTicket)
            ->whereNotNull('heure_exact');
            
        // Filtrer par agence seulement si une agence est spécifiée
        if ($agenceId) {
            $query->where('agence_id', $agenceId);
        } else {
            $query->whereNull('agence_id');
        }
        
        $ticketsExistants = $query->orderBy('heure_exact', 'asc')->get();

        foreach ($ticketsExistants as $ticket) {
            $ticketStart = Carbon::parse($ticket->heure_exact);
            $ticketEnd = $ticketStart->copy()->addMinutes($dureeTotale);

            // Vérifier s'il y a un chevauchement
            // Un chevauchement existe si :
            // (Nouvelle Heure Début < Heure Fin Ticket Existant) ET (Heure Début Ticket Existant < Nouvelle Heure Fin)
            $newEnd = $start->copy()->addMinutes($dureeTotale);

            if ($start->lt($ticketEnd) && $ticketStart->lt($newEnd)) {
                // Chevauchement détecté : on décale le début à la fin du ticket existant
                $start = $ticketEnd;
            }
        }

        return $start;
    }

    private function verifierHorairesOuverture($heureExact, $entreprise)
    {
        $heureExact = Carbon::parse($heureExact);
        $heureOuverture = Carbon::parse($entreprise->heure_ouv);
        $heureFermeture = Carbon::parse($entreprise->heure_ferm);

        // Extraire uniquement les heures pour la comparaison
        $heureExactHHMM = $heureExact->format('H:i');
        $heureOuvertureHHMM = $heureOuverture->format('H:i');
        $heureFermetureHHMM = $heureFermeture->format('H:i');

        // Si l'heure exacte est en dehors des horaires d'ouverture
        if ($heureExactHHMM < $heureOuvertureHHMM || $heureExactHHMM > $heureFermetureHHMM) {
            return false;
        }

        return true;
    }

    public function pageOtp()
    {
        return view('clients.page_otp');
    }

    public function pageTicket($ticketId = null)
    {
        if ($ticketId) {
            $ticket = Ticket::with(['client', 'client.utilisateur', 'service', 'service.entreprise', 'fileAttente'])
                ->where('id', $ticketId)
                ->first();
        } else {
            // Si pas de ticketId, essayer de récupérer via auth si disponible
            if (auth()->check()) {
                $user = auth()->user();
                $client = Client::where('utilisateur_id', $user->id)->first();
                if ($client) {
                    $ticket = Ticket::with(['client', 'client.utilisateur', 'service', 'service.entreprise', 'fileAttente'])
                        ->where('client_id', $client->id)
                        ->orderBy('id', 'desc')
                        ->first();
                }
            }
        }

        if (!$ticket) {
            abort(403, 'Ticket non trouvé.');
        }

        if ($ticket->statut === 'en_attente' && $ticket->file_attente_id && $ticket->heure_exact) {
            $ticket->position = Ticket::where('file_attente_id', $ticket->file_attente_id)
                ->where('statut', 'en_attente')
                ->whereRaw('heure_exact < ?', [$ticket->heure_exact])
                ->count() + 1;
        }

        return view('tickets.page_ticket', compact('ticket'));
    }

    public function listeRebalancement()
    {
        $user = auth()->user();

        // Récupérer les tickets VIP en attente
        $ticketsVip = Ticket::with(['client', 'client.utilisateur', 'service', 'service.entreprise', 'fileAttente'])
            ->where('type', 'vip')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tickets.tickets_rebalancement', compact('ticketsVip'));
    }

    public function rebalancerTicket($ticketId)
    {
        try {
            DB::beginTransaction();

            // Récupérer le ticket avec ses relations
            $ticket = Ticket::with(['client', 'client.utilisateur', 'service', 'fileAttente'])->find($ticketId);

            if (!$ticket) {
                abort(403, 'Vous n êtes pas autorisé à accéder à cette page.');
            }

            if ($ticket->type !== 'vip') {
                abort(403, 'Vous n êtes pas autorisé à accéder à cette page.');
            }

            // Changer le type du ticket de 'vip' à 'standard'
            $oldFileAttente = $ticket->fileAttente;
            $ticket->type = 'standard';
            $ticket->motif = null;
            $ticket->save();

            // Déplacer le ticket de la file VIP vers la file standard
            $fileVip = FileAttente::where('service_id', $ticket->service_id)
                ->where('date', $ticket->jour_passage)
                ->where('type', 'vip')
                ->first();

            $fileStandard = FileAttente::where('service_id', $ticket->service_id)
                ->where('date', $ticket->jour_passage)
                ->where('type', 'standard')
                ->first();

            if ($fileVip) {
                $fileVip->decrement('nb_client_restant');
                $fileVip->decrement('nb_total');
            }

            if (!$fileStandard) {
                $fileStandard = FileAttente::create([
                    'date' => $ticket->jour_passage,
                    'nb_client_restant' => 1,
                    'nb_total' => 1,
                    'statut' => 'ouverte',
                    'service_id' => $ticket->service_id,
                    'type' => 'standard',
                ]);
            } else {
                $fileStandard->increment('nb_client_restant');
                $fileStandard->increment('nb_total');
            }


            // Mettre à jour file_attente_id du ticket
            $ticket->file_attente_id = $fileStandard->id;
            $ticket->save();

            // Envoyer notification au client
            $ticket->client->utilisateur->notify(new RebalancementTicket($ticket));

            DB::commit();

            return redirect()->back()->with('success', 'Ticket reclassé en standard avec succès. Client notifié.');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('Erreur rebalancement ticket', [
                'ticket_id' => $ticketId,
                'error' => $th->getMessage()
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue lors du rebalancement.');
        }
    }

    public function telechargerTicketPdf($ticketId)
    {
        try {
            $user = auth()->user();
            $client = Client::where('utilisateur_id', $user->id)->first();

            if (!$client) {
                abort(403, 'Vous n êtes pas autorisé à accéder à cette page.');
            }

            $ticket = Ticket::with(['client', 'client.utilisateur', 'service', 'service.entreprise', 'fileAttente'])
                ->where('id', $ticketId)
                ->where('client_id', $client->id)
                ->first();

            if (!$ticket) {
                abort(403, 'Ticket non trouvé ou vous n êtes pas autorisé à accéder à ce ticket.');
            }

            $url = route('page_ticket', ['ticketId' => $ticket->id]);

            $pdf = Browsershot::url($url)
                ->setOption('viewport', [
                    'width' => 320,
                    'height' => 800
                ])
                ->format('A4')
                ->margins(5, 5, 5, 5)
                ->showBrowserHeaderAndFooter(false)
                ->pdf();

            return response($pdf)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="ticket_' . $ticket->numero . '.pdf"');
        } catch (\Throwable $th) {
            Log::error('Erreur génération PDF ticket', [
                'ticket_id' => $ticketId,
                'error' => $th->getMessage()
            ]);
            abort(403, 'Une erreur est survenue lors de la génération du PDF. Veuillez réessayer plus tard.' . $th->getMessage());
        }
    }



    public function appelerProchain($id_service = null)
    {
        $user_connectee = auth()->user();
        $personnel = Personnel::where('utilisateur_id', $user_connectee->id)->first();

        // 1. Mettre le ticket en cours à "traite"
        $ticket_encours = Ticket::where('personnel_id', $personnel->id)
            ->where('statut', 'en_cours')
            ->whereDate('jour_passage', today())
            ->first();
        if ($ticket_encours) {
            $ticket_encours->statut = 'traite';
            $ticket_encours->date_fin_traitement = now();
            $ticket_encours->save();
        }

        // 2. Récupérer le ticket en_attente le plus ancien du service
        $prochain_ticket = Ticket::where('service_id', $id_service)
            ->where('statut', 'en_attente')
            ->whereDate('created_at', today()) // créé aujourd'hui
            ->oldest('created_at')
            ->first();

        if ($prochain_ticket) {
            $prochain_ticket->statut = 'en_cours';
            $prochain_ticket->personnel_id = $personnel->id;
            $prochain_ticket->date_debut_traitement = now();
            $prochain_ticket->save();
        }

        // 3. Rediriger vers la liste des tickets en attente du service
        return redirect()->back()->with('success', 'Prochain ticket appelé avec succès.');
    }

    public function mesTickets(Request $request)
    {
        $user = auth()->user();
        $client = Client::where('utilisateur_id', $user->id)->first();

        if (!$client) {
            return redirect()->route('Acceuil')->with('error', 'Vous devez être enregistré comme client pour accéder à cette page.');
        }

        $filtre = $request->query('statut', 'tous');

        $query = Ticket::with(['service', 'service.entreprise', 'fileAttente', 'agence'])
            ->where('client_id', $client->id);

        if ($filtre !== 'tous') {
            $query->where('statut', $filtre);
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(15);

        foreach ($tickets as $ticket) {
            if ($ticket->statut === 'en_attente' && $ticket->file_attente_id && $ticket->heure_exact) {
                $ticket->position = Ticket::where('file_attente_id', $ticket->file_attente_id)
                    ->where('statut', 'en_attente')
                    ->whereRaw('heure_exact < ?', [$ticket->heure_exact])
                    ->count() + 1;
            }
        }

        $ticketsParStatut = [
            'tous' => Ticket::where('client_id', $client->id)->count(),
            'en_attente' => Ticket::where('client_id', $client->id)->where('statut', 'en_attente')->count(),
            'en_cours' => Ticket::where('client_id', $client->id)->where('statut', 'en_cours')->count(),
            'traite' => Ticket::where('client_id', $client->id)->where('statut', 'traite')->count(),
            'annule' => Ticket::where('client_id', $client->id)->where('statut', 'annule')->count(),
        ];

        return view('tickets.mes_tickets', compact('tickets', 'filtre', 'ticketsParStatut'));
    }

    public function annulerTicket(Request $request, $ticketId)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();
            $client = Client::where('utilisateur_id', $user->id)->first();

            if (!$client) {
                return redirect()->back()->with('error', 'Vous devez être enregistré comme client.');
            }

            $ticket = Ticket::with('fileAttente')->find($ticketId);

            if (!$ticket) {
                return redirect()->back()->with('error', 'Ticket non trouvé.');
            }

            if ($ticket->client_id !== $client->id) {
                abort(403, 'Vous n\'êtes pas autorisé à annuler ce ticket.');
            }

            if (!in_array($ticket->statut, ['en_attente', 'en_cours'])) {
                return redirect()->back()->with('error', 'Ce ticket ne peut plus être annulé.');
            }

            $ancienStatut = $ticket->statut;
            $ticket->statut = 'annule';
            $ticket->save();

            if ($ticket->fileAttente) {
                $ticket->fileAttente->decrement('nb_total');
                
                if ($ancienStatut === 'en_attente') {
                    $ticket->fileAttente->decrement('nb_client_restant');
                }
            }

            DB::commit();

            return redirect()->route('mes_tickets')->with('success', 'Ticket annulé avec succès.');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('Erreur annulation ticket', [
                'ticket_id' => $ticketId,
                'error' => $th->getMessage()
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'annulation.');
        }
    }
}
