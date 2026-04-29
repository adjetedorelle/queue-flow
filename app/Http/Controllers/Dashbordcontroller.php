<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\FileAttente;
use App\Models\Personnel;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;

class Dashbordcontroller extends Controller
{
    public function affichage()
    {
        // Valeurs par défaut pour éviter les erreurs de variables indéfinies
        $nbentreprises = $nbadmins = $nbtickets = $nbservices = $nbpersonnels = $nbfiles = 0;
        $entreprisesrecentes = $adminsrecents = $services = $personnels = $files = collect();
        $entreprise=$servicesrecentes = null;

        if (auth()->user()->role === 'super-admin') {
            $nbentreprises = Entreprise::count();
            $nbadmins = Admin::count();
            $nbtickets = Ticket::count();
            $files = FileAttente::where('statut', 'ouverte')->get();
            $entreprisesrecentes = Entreprise::with(['services', 'personnels'])->latest()->take(5)->get();
            $adminsrecents = Admin::with(['utilisateur', 'entreprise'])->latest()->take(5)->get();
        }

        if (auth()->user()->role === 'admin') {
            $admin = Admin::where('utilisateur_id', auth()->id())->firstOrFail();
            $entreprise = Entreprise::where('admin_id', $admin->id)->firstOrFail();
            $services = Service::where('entreprise_id', $entreprise->id)->get();
            $servicesrecentes = Service::where('entreprise_id', $entreprise->id)->latest()->take(5)->get();
            $serviceIds = $services->pluck('id');
            $nbservices = $services->count();
            $nbtickets = Ticket::whereIn('service_id', $serviceIds)->whereDate('created_at', today())->count();
            $personnels = Personnel::where('entreprise_id', $entreprise->id)->get();
            $nbpersonnels = $personnels->count();
            $files = FileAttente::whereIn('service_id', $serviceIds)->where('statut', 'ouverte')
            ->whereDate('created_at', today())
            ->get();
            $nbfiles = $files->count();
        }

        return view('dashboard', compact(
            'nbentreprises', 'nbadmins', 'nbtickets',
            'nbservices', 'nbpersonnels', 'nbfiles',
            'entreprisesrecentes', 'adminsrecents',
            'servicesrecentes', 'personnels', 'files', 'entreprise'
        ));
    }
}