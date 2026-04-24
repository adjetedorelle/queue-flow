<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\FileAttente;
use App\Models\Personnel;
use App\Models\Service;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function filesActives () {
    $user_connectee = auth()->user();
    if ($user_connectee -> role === 'personnel') {
       $personnel=Personnel::WHERE('utilisateur_id','=',$user_connectee->id)->first();
       $services=Service::WHERE('entreprise_id','=',$personnel->entreprise_id)->get(['id']);
       $files=FileAttente::WHEREIN('service_id',$services)
                          ->where('statut', '=', 'ouverte')
                          ->whereDate('date', now())
                          ->paginate(6);
    }

    if ($user_connectee -> role === 'admin') {
    $admin=Admin::WHERE('utilisateur_id','=',$user_connectee->id)->first();
    $entreprise = Entreprise::WHERE('admin_id','=',$admin->id)->first();
    $services=Service::WHERE('entreprise_id','=',$entreprise->id)->get(['id']);
    $files=FileAttente::WHEREIN('service_id',$services)
                          ->where('statut', '=', 'ouverte')
                          ->whereDate('date', now())
                          ->paginate(6);

   }
   
    if ($user_connectee -> role === 'super-admin') {
       $files = FileAttente::where('statut', 'ouverte')
                   ->whereDate('date', now())
                    ->paginate(6);     
    }
    return view('files.files_disponibles', compact('files'));
   
}
}
