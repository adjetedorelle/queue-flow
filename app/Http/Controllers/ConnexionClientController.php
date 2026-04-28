<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Notifications\EnvoyerOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ConnexionClientController extends Controller
{
    public function connexionClient (Request $request)
        {
            // enlever les espaces avant et après le numero de téléphone et l'email
            $tel= trim($request['tel']);
            $email= trim($request['email']);
      // Valider le numero de telephone et l'email
            $request->validate([
                'tel' => 'required|',
                'email' => 'nullable|email',
            ]);
            
            Log::info('Début connexion client', ['tel' => $tel, 'email' => $email]);
            
       // Verifier si le numero de téléphone ou l'email se trouve dans la base de donnees
            $utilisateurExistant= User::where(function($query) use ($tel, $email) {
                $query->where('tel', $tel)
                      ->orWhere('email', $email);
            })->first();

            Log::info('Utilisateur existant trouvé', [
                'exists' => !is_null($utilisateurExistant),
                'user_id' => $utilisateurExistant?->id,
                'search_tel' => $tel,
                'search_email' => $email
            ]);
            
            // Generer un code otp a 6 chiffres
            $code_otp= rand(100000,999999);
          
        // Déterminer le canal : priorité email si disponible, sinon WhatsApp
        $channel = (!empty($email) && !empty($utilisateurExistant?->email)) ? 'mail' : 'whatsapp';
        
        Log::info('Canal choisi pour OTP', ['channel' => $channel, 'has_email' => !empty($email), 'has_user_email' => !empty($utilisateurExistant?->email)]);
        
        // Vérifier le mode API (test ou production)
        $apiKey = config('zavu.api_key');
        $isTestMode = str_starts_with($apiKey, 'zv_test_');
        Log::info('Mode API Zavu.dev', ['is_test' => $isTestMode, 'api_key_prefix' => substr($apiKey, 0, 20) . '...']);
        
        // Enregistrer les données OTP dans la session
        session()->put('code_otp', $code_otp);
        session()->put('otp_expires_at', now()->addMinutes(5));
        session()->put('otp_attempts', 0);
        session()->put('otp_channel', $channel);
        session()->put('otp_user_id', $utilisateurExistant?->id);
        
        Log::info('OTP généré et stocké en session', ['expires_at' => now()->addMinutes(5)->toDateTimeString()]);
        
        // Si le numero de téléphone ou l'email n'existe pas dans la base de donnees, creer un nouvel utilisateur et un client et envoyer le code otp
            try {
                DB::beginTransaction();

                    if (!$utilisateurExistant) {
                    $user= User::create([
                        'email' => $email,
                        'tel' => $tel,
                        'role' => 'client',
                        'nom' => 'Client', // Valeur par défaut, sera mis à jour dans page_otp
                        'prenom' => '', // Valeur par défaut
                    ]);

                    Client::create([
                        'utilisateur_id' => $user->id,
                        'vip' => false
                    ]);

                    session()->put('otp_user_id', $user->id);
                    Log::info('Nouvel utilisateur créé', ['user_id' => $user->id]);
                } else{
                    $user= $utilisateurExistant;
                    Log::info('Utilisateur existant réutilisé', ['user_id' => $user->id]);
                }

                // Envoyer le code otp selon le canal prioritaire
                if ($channel === 'mail') {
                    Notification::send($user, new EnvoyerOtp($code_otp, $channel));
                    Log::info('Notification OTP envoyée par mail', ['user_id' => $user->id]);
                } elseif ($channel === 'whatsapp') {
                    // Envoi direct via Zavu.dev sans passer par Laravel Notifications
                    $notification = new EnvoyerOtp($code_otp, $channel);
                    $result = $notification->toZavuWhatsApp($user);
                    Log::info('Notification OTP envoyée par WhatsApp', ['user_id' => $user->id, 'result' => $result]);
                }
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                Log::error('Erreur lors de la création utilisateur ou envoi OTP', ['error' => $th->getMessage()]);
                return redirect()->back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
            }
            return view ('clients.page_otp',compact('utilisateurExistant', 'channel'));
        }

    public function showOtpForm()
    {
        // Vérifier si l'OTP existe en session
        if (!session('code_otp')) {
            return redirect()->route('connexion_client')->with('error', 'Veuillez d\'abord demander un code de vérification.');
        }

        $utilisateurExistant = User::find(session('otp_user_id'));
        $channel = session('otp_channel', 'whatsapp');

        return view('clients.page_otp', compact('utilisateurExistant', 'channel'));
    }

    public function verifierOtp(Request $request)
    {
    
        $request->validate([
            'otp' => 'required|array|min:6|max:6',
            'otp.*' => 'required|numeric',
        ]);

        $otpSaisi = implode('', $request->otp);
        $codeOtpSession = session('code_otp');
        $otpExpiresAt = session('otp_expires_at');
        $otpAttempts = session('otp_attempts', 0);
        $userId = session('otp_user_id');
        $channel = session('otp_channel');

        Log::info('Début vérification OTP', [
            'otp_saisi' => $otpSaisi,
            'user_id' => $userId,
            'attempts' => $otpAttempts,
            'expires_at' => $otpExpiresAt?->toDateTimeString()
        ]);

        // Vérifier si le code a expiré
        if (now()->greaterThan($otpExpiresAt)) {
            Log::warning('Code OTP expiré', ['expires_at' => $otpExpiresAt?->toDateTimeString(), 'now' => now()->toDateTimeString()]);
            return redirect()->back()->with('error', 'Le code OTP a expiré. Veuillez demander un nouveau code.');
        }

        // Vérifier si le nombre de tentatives est dépassé
        if ($otpAttempts >= 3) {
            Log::warning('Trop de tentatives OTP', ['attempts' => $otpAttempts, 'user_id' => $userId]);
            
            // Régénérer un nouveau code
            $nouveauCodeOtp = rand(100000, 999999);
            session()->put('code_otp', $nouveauCodeOtp);
            session()->put('otp_expires_at', now()->addMinutes(5));
            session()->put('otp_attempts', 0);

            Log::info('Nouveau code OTP généré après échec', ['user_id' => $userId, 'new_expires_at' => now()->addMinutes(5)->toDateTimeString()]);

            // Renvoyer le nouveau code
            $user = User::find($userId);
            if ($user) {
                Notification::send($user, new EnvoyerOtp($nouveauCodeOtp, $channel));
                Log::info('Nouveau code OTP envoyé', ['user_id' => $userId, 'channel' => $channel]);
            }

            return redirect()->back()->with('error', 'Trop de tentatives. Un nouveau code a été envoyé.');
        }

        // Vérifier si le code est correct
        if ($otpSaisi == $codeOtpSession) {
            Log::info('Code OTP correct', ['user_id' => $userId]);
            
            // Code correct : authentifier l'utilisateur
            $user = User::find($userId);
            if ($user) {
                Auth::login($user);
                
                // Nettoyer la session
                session()->forget(['code_otp', 'otp_expires_at', 'otp_attempts', 'otp_channel', 'otp_user_id']);
                
                Log::info('Utilisateur authentifié avec succès', ['user_id' => $userId, 'email' => $user->email]);

                return redirect()->route('Acceuil')->with('success', 'Connexion réussie !');
            }

            Log::error('Utilisateur non trouvé lors de la validation OTP', ['user_id' => $userId]);
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        // Code incorrect : incrémenter les tentatives
        $nouvellesTentatives = $otpAttempts + 1;
        session()->put('otp_attempts', $nouvellesTentatives);
        $tentativesRestantes = 3 - $nouvellesTentatives;

        Log::warning('Code OTP incorrect', [
            'attempt' => $nouvellesTentatives,
            'remaining' => $tentativesRestantes,
            'user_id' => $userId
        ]);

        return redirect()->back()->with('error', "Code incorrect. Il vous reste $tentativesRestantes tentative(s).");
    }
}
