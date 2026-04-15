<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function create(){
        return view('entreprises.create');
    }
    
    public function enregistrer_entreprise(Request $request){
        $request->validate([
            'nom_ent'=> 'string|required|max:100',
            'adresse'=> 'string|nullable|max:150',
            'heure_ouv'=> 'string|required|max:05',
            'heure_ferm'=> 'string|required|max:05',
            'jour_ouv'=> 'string|required|max:100',
            'nom'=> 'string|required|max:100',
            'prenom'=> 'string|required|max:100',
            'email'=> 'string|required|max:100',
            'password'=> 'string|required|max:100'           
        ]);

        $user = User::create([
         'nom'=>$request->nom,
         'prenom'=>$request->prenom,
         'email'=>$request->email,
         'password'=>bcrypt($request->password),
         'role'=>'admin'
        ]);

       $admin = Admin::create([
            'utilisateur_id'=>$user->id
        ]);

        Entreprise::create([
            'nom_ent'=>$request->nom_ent,
            'adresse'=>$request->adresse,
            'heure_ouv'=>$request->heure_ouv,
            'heure_ferm'=>$request->heure_ferm,
            'jour_ouv'=>$request->jour_ouv,
            'admin_id'=>$admin->id

        ]);
       
        return redirect(route('liste_entreprises'));
    }

    public function liste(){
        $entreprises = Entreprise::paginate(10) ;
        return view('entreprises.liste',compact('entreprises'));
    }

    public function modifier ($id_entreprise) {
       $entreprise = Entreprise::where('id', '=',$id_entreprise)->first();
       return view('entreprises.formulaire',compact('entreprise'));
    }
    public function mettreAjour (Request $request, $id_entreprise) {
         $request->validate([
            'nom_ent'=> 'string|required|max:100',
            'adresse'=> 'string|nullable|max:150',
            'heure_ouv'=> 'string|required|max:10',
             'heure_ferm'=> 'string|required|max:10',
             'jour_ouv'=> 'string|required|max:100',
            
        ]);
               
       $entreprise = Entreprise::where('id', '=',$id_entreprise)->first();
       $entreprise->update([
        'nom_ent'=> $request->nom_ent,
        'adresse'=> $request->adresse,
        'heure_ouv'=> $request->heure_ouv,
        'heure_ferm'=> $request->heure_ferm,
        'jour_ouv'=> $request->jour_ouv,
       ]);
        return redirect(route('liste_entreprises'));
      
    }
}
