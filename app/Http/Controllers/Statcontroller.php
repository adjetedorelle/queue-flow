<?php

namespace App\Http\Controllers;

use App\Exports\EntreprisesExport;
use App\Exports\TicketsExport;
use App\Models\Admin;
use App\Models\Entreprise;
use Maatwebsite\Excel\Facades\Excel;

class Statcontroller extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'super-admin') {
            return view('statistiques.superadmin');
        }

        if (auth()->user()->role === 'admin') {
            $admin = Admin::where('utilisateur_id', auth()->id())->firstOrFail();
            $entreprise = Entreprise::where('admin_id', $admin->id)->firstOrFail();
            return view('statistiques.admin', compact('entreprise'));
        }
    }

    // ---- Super-admin exports ----

    public function exportEntreprises()
    {
        return Excel::download(
            new EntreprisesExport(),
            'entreprises_' . now()->format('d-m-Y') . '.xlsx'
        );
    }

    public function exportTousTickets()
    {
        return Excel::download(
            new TicketsExport(),
            'tous_tickets_' . now()->format('d-m-Y') . '.xlsx'
        );
    }

    // ---- Admin export ----

    public function exportTicketsAdmin()
    {
        $admin = Admin::where('utilisateur_id', auth()->id())->firstOrFail();
        $entreprise = Entreprise::where('admin_id', $admin->id)->firstOrFail();

        return Excel::download(
            new TicketsExport($entreprise->id),
            'tickets_' . $entreprise->nom_ent . '_' . now()->format('d-m-Y') . '.xlsx'
        );
    }
}
