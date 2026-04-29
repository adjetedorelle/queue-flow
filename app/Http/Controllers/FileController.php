<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\FileAttente;
use App\Models\Personnel;
use App\Models\Service;
use App\Models\Ticket;
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
       $nbfiles = $files->count();
       $nbClients = Ticket::whereIn('service_id', $services)
                           ->whereDate('created_at', today())
                           ->count();
          $filesClosed = FileAttente::whereIn('service_id', $services)
                              ->where('statut', 'fermee')
                              ->whereDate('created_at', today())
                              ->get();

    $tempsMoyen = $filesClosed->avg(function($file) {
        return $file->created_at->diffInMinutes($file->updated_at);
    });
    $tempsMoyen = round($tempsMoyen ?? 0);                        
    }

    if ($user_connectee -> role === 'admin') {
    $admin=Admin::WHERE('utilisateur_id','=',$user_connectee->id)->first();
    $entreprise = Entreprise::WHERE('admin_id','=',$admin->id)->first();
    $services=Service::WHERE('entreprise_id','=',$entreprise->id)->get(['id']);
    $files=FileAttente::WHEREIN('service_id',$services)
                          ->where('statut', '=', 'ouverte')
                          ->whereDate('date', now())
                          ->paginate(6);
    $nbfiles = $files->count();
    $nbClients = Ticket::whereIn('service_id', $services)
                           ->whereDate('created_at', today())
                           ->count();
    $filesClosed = FileAttente::whereIn('service_id', $services)
                              ->where('statut', 'fermee')
                              ->whereDate('created_at', today())
                              ->get();

    $tempsMoyen = $filesClosed->avg(function($file) {
        return $file->created_at->diffInMinutes($file->updated_at);
    });
    $tempsMoyen = round($tempsMoyen ?? 0);                 
    
   }
   
    if ($user_connectee -> role === 'super-admin') {
        $services = Service::pluck('id');
       $files = FileAttente::where('statut', 'ouverte')
                   ->whereDate('date', now())
                    ->paginate(6);  
       $nbfiles = $files->count();
       $nbClients = Ticket::whereDate('created_at', today())->count();
        $filesClosed = FileAttente::whereIn('service_id', $services)
                              ->where('statut', 'fermee')
                              ->whereDate('created_at', today())
                              ->get();

    $tempsMoyen = $filesClosed->avg(function($file) {
        return $file->created_at->diffInMinutes($file->updated_at);
    });
    $tempsMoyen = round($tempsMoyen ?? 0);   

    }
    return view('files.files_disponibles', compact('files', 'nbfiles', 'nbClients', 'tempsMoyen'));
   
}
}
