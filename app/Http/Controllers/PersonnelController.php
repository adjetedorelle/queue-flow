<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function ajoutPersonnel () {
        return view('personnels.ajouter_personnel');
    }

    public function enregistrerPersonnel(Request $request) {
       $request->validate([
        'nom'=>'string|required|max:200',
        'prenom'=>'string|required|max:200',
        'email'=>'string|required|max:200',
        'password'=>'string|required|max:200'
       ]);

        $user_connecte = auth() -> user();
        $admin = Admin::WHERE('utilisateur_id','=',$user_connecte->id) ->first();
            if ($admin)
        {
            $entreprise = Entreprise::WHERE('admin_id','=',$admin->id) ->first();

        }
       $user = User::create ([
        'nom'=>$request->nom,
        'prenom'=>$request->prenom,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'role'=>'personnel'
       ]);

       Personnel::create([
        'utilisateur_id'=>$user->id,
         'entreprise_id'=>$entreprise->id
       ]);

       return redirect(route('liste_personnel'));
    }

    public function listePersonnel () {
        $personnels= Personnel::paginate(10);
        return view('personnels.liste_personnel', compact('personnels'));
    }

    public function modifier($id_user) {
        $user = User::find($id_user);
        return view('personnels.formulaire_personnel',compact('user'));

    }

    public function mettreAjour(Request $request, $id_user){
        $request->validate([
        'nom'=>'string|required|max:200',
        'prenom'=>'string|required|max:200',
        'email'=>'string|required|max:200',
        ]);
    
       $user = User::find($id_user);
       $user->update([
        'nom'=>$request->nom,
        'prenom'=>$request->prenom,
        'email'=>$request->email
       ]);

       return redirect(route('liste_personnel'));
    }

    public function supprimer ($id_user) {
      $user = User::find($id_user);
      $user->delete();
      return redirect()->back();
 
    }
}
