<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Personnel;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ticketsdispo ( ) {
    $user_connectee=auth()->user();
    if ($user_connectee->role === 'super-admin') {
       $tickets = Ticket::all();
       
    }

    if ($user_connectee->role === 'personnel') {
       $personnel=Personnel::WHERE('utilisateur_id','=',$user_connectee->id)->first();
       $services=Service::WHERE('entreprise_id','=',$personnel->entreprise_id)->get(['id']);
       $tickets=Ticket::WHEREIN('service_id',$services)->paginate(6); 



    }
  
    if ($user_connectee->role === 'admin') {
      $admin=Admin::WHERE('utilisateur_id','=',$user_connectee->id)->first();
      $services=Service::WHERE('entreprise_id','=',$admin->entreprise_id)->get(['id']);
      $tickets=Ticket::WHEREIN('service_id',$services)->paginate(6);  
      
    }
    
    return view('tickets.tickets_dispo', compact('tickets'));

}

public function ticketsNonTraites ($id_service) {
    $user_connectee=auth()->user();
    if($user_connectee->role === 'personnel') {
        $personnel=Personnel::WHERE('utilisateur_id','=',$user_connectee->id)->first();
        $ticket_encour=Ticket::WHERE('personnel_id','=',$personnel->id)
        ->WHERE('statut', '=', 'en_cours')
        // use between to compare date collumn  jour de passage with today start date and today end date
        ->WHERE('jour_passage', '>=', today()->startOfDay())
        ->WHERE('jour_passage', '<=', today()->endOfDay())
        ->first();
       
    }
    
    $tickets = Ticket::WHERE('service_id', '=', $id_service)
    ->WHEREIN('statut', ['en_attente', 'en_cours'])
    ->get();
    $count= $tickets->count();
    return view('tickets.tickets_en_attente', compact('tickets', 'ticket_encour', 'count'));
}

    public function formulaireDate () {
    return view ('tickets.formulaire_date');
    }

public function pageOtp (){
    return view ('clients.page_otp');
}

public function pageTicket (){
    return view ('tickets.page_ticket');
}
}