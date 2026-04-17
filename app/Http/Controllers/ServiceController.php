<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
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
    
        $services = Service::paginate(10) ;
        return view('services.tableauService',compact('services'));
    
        return view('services.tableauService');
    }

}
