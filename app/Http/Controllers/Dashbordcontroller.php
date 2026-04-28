<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\FileAttente;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;

class Dashbordcontroller extends Controller
{   
    public function affichage(){
       if (auth()->user()->role === 'super-admin'|| auth()->user()->role === 'admin'|| auth()->user()->role === 'personnel') {

        $entreprises = Entreprise::all();
        $entreprisesrecentes=Entreprise::latest()->take(5)->get();
        $nbentreprises = $entreprises->count();
        $admins=Admin::all();
        $adminsrecents=Admin::latest()->take(5)->get();
        $nbadmins = $admins->count();
        $tickets = Ticket::all();
        $nbtickets = $tickets->count();
        $files = FileAttente::where('statut','=','ouverte')->get();
        return view('dashboard',compact('nbentreprises','nbadmins','nbtickets','files','entreprisesrecentes','adminsrecents'));

    }




    }
}
