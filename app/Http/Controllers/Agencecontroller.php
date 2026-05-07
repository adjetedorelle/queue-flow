<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Agence;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class Agencecontroller extends Controller
{
        public function ajoutAgence () {
            return view('agences.ajouter_agence');
        }

        public function enregistrerAgence(Request $request) {
            $request->validate([
                'nom'=>'string|required|max:200',
                'adresse'=>'string|required|max:200',
            ]);
           
                $user_connecte = auth() -> user();
                $admin = Admin::WHERE('utilisateur_id','=',$user_connecte->id) ->first();
                    if ($admin)
                {
                    $entreprise = Entreprise::WHERE('admin_id','=',$admin->id) ->first();
    
                }
                Agence::create([
                    'nom'=>$request->nom,
                    'adresse'=>$request->adresse,
                    'entreprise_id'=>$entreprise->id
                ]);

            return redirect(route('liste_agences'));
        }

        public function listeAgences () {
            if (auth()->user()->role === 'admin') {
                $admin = Admin::WHERE('utilisateur_id','=',auth()->id()) ->first();
                $entreprise = Entreprise::WHERE('admin_id','=',$admin->id) ->first();
                $agences = Agence::WHERE('entreprise_id','=',$entreprise->id)->paginate(05);
            }   
            if (auth()->user()->role === 'super-admin') {
                $agences = Agence::paginate(05);
            }   
            return view('agences.liste_agences', compact('agences'));
        }

        public function modifier($id_agence) {
            $agence = Agence::findOrFail($id_agence);
            return view('agences.formulaire_agence', compact('agence'));
        }

        public function mettreAjour(Request $request, $id_agence) {
            $request->validate([
                'nom'=>'string|required|max:200',
                'adresse'=>'string|required|max:200',
            ]);

            $agence = Agence::findOrFail($id_agence);
            $agence->update([
                'nom'=>$request->nom,
                'adresse'=>$request->adresse,
            ]);

            return redirect(route('liste_agences'));
        }

        public function supprimer($id_agence) {
            $agence = Agence::findOrFail($id_agence);
            $agence->delete();
            return redirect(route('liste_agences'));
        }
}
