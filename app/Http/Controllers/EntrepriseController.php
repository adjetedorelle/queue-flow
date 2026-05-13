<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\FileAttente;
use App\Models\Personnel;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntrepriseController extends Controller
{
    public function create(){
        return view('entreprises.create');
    }
    
    public function enregistrer_entreprise(Request $request){
        $request->validate([
            'nom_ent'=> 'string|required|max:100',
            'adresse'=> 'string|nullable|max:150',
            'bio'=> 'string|required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'horaires'=> 'required|array',
            'horaires.*'=> 'required|array',
            'horaires.*.ferme'=> 'nullable|boolean',
            'horaires.*.plages'=> 'nullable|array',
            'horaires.*.plages.*.debut'=> 'nullable|date_format:H:i',
            'horaires.*.plages.*.fin'=> 'nullable|date_format:H:i|after:horaires.*.plages.*.debut',
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

        // Traiter les horaires
        $horaires = $this->traiterHoraires($request->horaires);

       Entreprise::create([
            'nom_ent'=>$request->nom_ent,
            'adresse'=>$request->adresse,
            'bio'=>$request->bio,
            'image' => $request->file('image')->store('entreprises', 'public'),
            'horaires'=>$horaires,
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
            'horaires'=> 'required|array',
            'horaires.*'=> 'required|array',
            'horaires.*.ferme'=> 'nullable|boolean',
            'horaires.*.plages'=> 'nullable|array',
            'horaires.*.plages.*.debut'=> 'nullable|date_format:H:i',
            'horaires.*.plages.*.fin'=> 'nullable|date_format:H:i',
            'bio'=> 'string|required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
               
       $entreprise = Entreprise::where('id', '=',$id_entreprise)->first();
       
       // Traiter les horaires
        $horaires = $this->traiterHoraires($request->horaires);
       
       if ($request->hasFile('image')) {
        $entreprise['image'] = $request->file('image')->store('entreprises', 'public');
    }
       $entreprise->update([
        'nom_ent'=> $request->nom_ent,
        'adresse'=> $request->adresse,
        'horaires'=> $horaires,
        'bio'=>$request->bio,

       ]);

       
        return redirect(route('liste_entreprises'));
      
    }
    public function afficher () {
         $entreprises = Entreprise::where('statut', '=' , 'actif')->paginate(6) ;
        return view('entreprises.disponibles',compact('entreprises'));
    }

    public function supprimer($id) {
      
    $entreprise = Entreprise::findOrFail($id);

    if ($entreprise->image && Storage::disk('public')->exists($entreprise->image)) {
        Storage::disk('public')->delete($entreprise->image);
    }

    $entreprise->delete();

    return redirect()->back()->with('success', 'Entreprise supprimée avec succès.');
} 
 
public function toggleStatut($id_entreprise)
{
    $entreprise = Entreprise::findOrFail($id_entreprise);
    $entreprise->statut = $entreprise->statut === 'actif' ? 'suspendu' : 'actif';
    $entreprise->save();

    return back()->with('success', 'Statut mis à jour avec succès.');
}

/**
 * Traite et nettoie les horaires reçus du formulaire
 */
private function traiterHoraires($horairesInput)
{
    $horaires = [];
    $joursSemaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    
    foreach ($joursSemaine as $jour) {
        if (!isset($horairesInput[$jour])) {
            // Si le jour n'est pas dans l'input, le marquer comme fermé
            $horaires[$jour] = [
                'ferme' => true,
                'plages' => []
            ];
            continue;
        }
        
        $jourData = $horairesInput[$jour];
        $ferme = isset($jourData['ferme']) && $jourData['ferme'] == '1';
        
        if ($ferme) {
            $horaires[$jour] = [
                'ferme' => true,
                'plages' => []
            ];
        } else {
            // Filtrer les plages vides
            $plages = [];
            if (isset($jourData['plages']) && is_array($jourData['plages'])) {
                foreach ($jourData['plages'] as $plage) {
                    if (!empty($plage['debut']) && !empty($plage['fin'])) {
                        $plages[] = [
                            'debut' => $plage['debut'],
                            'fin' => $plage['fin']
                        ];
                    }
                }
            }
            
            $horaires[$jour] = [
                'ferme' => false,
                'plages' => $plages
            ];
        }
    }
    
    return $horaires;
}

   
}