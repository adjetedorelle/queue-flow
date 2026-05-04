<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\Personnel;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function ajoutService()
    {
        return view('services.ajouter_service');
    }

    public function enregistrerService(Request $request)
    {   
        $request->validate([
            'libelle'=> 'string|required|max:100',
            'temps_estime'=> 'string|required|max:50',    
        ]);
                 
        $user = auth() -> user();
        $admin = Admin::WHERE('utilisateur_id','=',$user->id) ->first();
            if ($admin)
        {
            $entreprise = Entreprise::WHERE('admin_id','=',$admin->id) ->first();
          
        } else {
            return redirect()->back()->withErrors('Vous n\'êtes pas autorisé à ajouter un service.');
        }

        Service::create([
            'libelle'=>$request->libelle,
            'temps_estime'=>$request->temps_estime,
            'entreprise_id'=>$entreprise->id,
        ]);

    return redirect(route('service_liste') );
    }
    
    public function listes()
    {   
        $user = auth() -> user(); 
        if ($user->role === 'admin') {
            $admin = Admin::WHERE('utilisateur_id','=',$user->id) ->first();
            $entreprise = Entreprise::WHERE('admin_id','=',$admin->id) ->first();
            $services = Service::WHERE('entreprise_id','=',$entreprise->id)->paginate(06) ;
        
        } 
        if($user->role === 'personnel') {
            $personnel = Personnel::WHERE('utilisateur_id','=',$user->id) ->first();
            $services = Service::WHERE('entreprise_id','=',$personnel->entreprise_id)->paginate(06) ;
        }

        if($user->role === 'super-admin') {
            $services = Service::paginate(06) ;
        }
        return view('services.tableauService',compact('services'));  
    }

     public function modifier ($id_service) {
       $service = Service::where('id', '=',$id_service)->first();
        return view('services.formulaire_modification', compact('service'));
     }

     public function mettreAjour(Request $request , $id_service) {
        $request->validate([
            'libelle'=> 'string|required|max:100',
            'temps_estime'=> 'string|required|max:50',    
        ]);
       $service = Service::where('id', '=',$id_service)->first();
       $service->update([
          'libelle'=>$request->libelle,
          'temps_estime'=>$request->temps_estime
       ]);

    return redirect(route('service_liste') );

     }

     public function supprimer($id_service){
        $service = Service::where('id', '=',$id_service)->first();
        $service->delete();
        return redirect()->back();
     }

     public function servicedispo ($id_entreprise) {
        $services=Service::WHERE('entreprise_id','=',$id_entreprise)->get();
        return view('services.services_dispo', compact('services'));
     }
}
