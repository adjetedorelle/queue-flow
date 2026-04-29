<?php

namespace App\Exports;

use App\Models\Entreprise;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class EntreprisesExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Entreprise::with('admin.utilisateur')->get()->map(function ($e) {
            return [
                'Nom entreprise'   => $e->nom_ent,
                'Statut'           => $e->statut,
                'Administrateur'   => $e->admin?->utilisateur?->nom . ' ' . $e->admin?->utilisateur?->prenom,
                'Email admin'      => $e->admin?->utilisateur?->email,
                'Nb services'      => $e->services()->count(),
                'Date inscription' => $e->created_at->format('d/m/Y'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nom entreprise',
            'Statut',
            'Administrateur',
            'Email admin',
            'Nb services',
            'Date inscription',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
