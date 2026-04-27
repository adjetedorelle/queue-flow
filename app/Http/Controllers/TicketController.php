<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\Personnel;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ticketsdispo(Request $request)
{
    $user_connectee = auth()->user();
    $filtre = $request->query('filtre', 'tous'); // 'tous', 'aujourd_hui', 'prioritaires'

    // Base query selon le rôle
    if ($user_connectee->role === 'super-admin') {
        $query = Ticket::query();
        $ticketsResolus = Ticket::where('statut', 'traite')->count();
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
        $entreprise=Entreprise::where('admin_id', $admin->id)->first();
        $services = Service::where('entreprise_id', $entreprise->id)->pluck('id');
        $query = Ticket::whereIn('service_id', $services);
        $ticketsResolus = Ticket::whereIn('service_id', $services)
                                ->where('statut', 'traite')
                                ->count();
    }

    // Application des filtres
    if ($filtre === 'aujourd_hui') {
        $query->whereDate('jour_passage', today());
    }

    if ($filtre === 'prioritaires') {
        $query->where('type', 'express'); // adapte selon ton champ
    }

    $tickets = $query->paginate(6);

    return view('tickets.tickets_dispo', compact('tickets', 'filtre','ticketsResolus'));
}

    public function ticketsNonTraites ($id_service) {
    $ticket_encour = null;
    $user_connectee=auth()->user();
    if($user_connectee->role === 'personnel') {
        $personnel=Personnel::WHERE('utilisateur_id','=',$user_connectee->id)->first();
        $ticket_encour=Ticket::WHERE('personnel_id','=',$personnel->id)
        ->WHERE('statut', '=', 'en_cours')
        // use between to compare date collumn  jour de passage with today start date and today end date
        ->WHERE('jour_passage', '>=', today()->startOfDay())
        ->WHERE('jour_passage', '<=', today()->endOfDay())
        ->first();
       
    }
    
    $tickets = Ticket::WHERE('service_id', '=', $id_service)
    ->WHEREIN('statut', ['en_attente', 'en_cours'])
    ->get();
    $count= $tickets->count();
    return view('tickets.tickets_en_attente', compact('tickets', 'ticket_encour', 'count'));
}

   

public function pageTicket (){
    return view ('tickets.page_ticket');
}


    public function appelerProchain($id_service)
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
    return redirect()->route('tickets_en_attente', ['id_service' => $id_service]);
}

}