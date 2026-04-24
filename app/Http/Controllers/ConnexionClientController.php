<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Notifications\EnvoyerOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ConnexionClientController extends Controller
{
    public function connexionClient (Request $request)
        {
            // enlever les espaces avant et après le numero de telephone et l'email
            $tel= trim($request['tel']);
            $email= trim($request['email']);
      // Valider le numero de telephone et l'email
            $request->validate([
                'tel' => 'required|',
                'email' => 'nullable|email',
            ]);
       // Verifier si le numero de telephone ou l'email se trouve dans la base de donnees 
            $utilisateurExistant= User::where ('tel', '=', $tel)->orwhere('email', '=', $email)->first();
            // Generer un code otp a 6 chiffres
            $code_otp= rand(100000,999999);
          
        // Enregistrer le code otp dans la session
            session()->put('code_otp', $code_otp);
        // Si le numero de telephone ou l'email n'existe pas dans la base de donnees, creer un nouvel utilisateur et un client et envoyer le code otp par email
            try {
                DB::beginTransaction();

                    if (!$utilisateurExistant) {
                    $user= User::create([
                        'email' => $email,
                        'tel' => $tel,
                        'role' => 'client',
                    ]);

                    Client::create([
                        'utilisateur_id' => $user->id,
                        'vip' => false
                    ]);
                } else{
                    $user= $utilisateurExistant;
                }

                // Envoyer le code otp par email
                Notification::send($user, new EnvoyerOtp($code_otp));
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                //throw $th;
            }
            return view ('clients.page_otp',compact('utilisateurExistant'));
        }
    
}
