<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TicketsExport implements FromCollection, WithHeadings, WithStyles
{
    protected $entrepriseId;

    // Si entrepriseId est null => tous les tickets (super-admin)
    // Sinon => tickets filtrés (admin)
    public function __construct($entrepriseId = null)
    {
        $this->entrepriseId = $entrepriseId;
    }

    public function collection()
    {
        $query = Ticket::with(['service.entreprise']);

        if ($this->entrepriseId) {
            $serviceIds = \App\Models\Service::where('entreprise_id', $this->entrepriseId)
                                             ->pluck('id');
            $query->whereIn('service_id', $serviceIds);
        }

        return $query->get()->map(function ($t) {
            return [
                'Numéro ticket'  => $t->numero,
                'Entreprise'     => $t->service?->entreprise?->nom_ent,
                'Service'        => $t->service?->libelle,
                'Date de passage'=> $t->created_at->format('d/m/Y H:i:s'),
                'Statut'         => $t->statut,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Numéro ticket',
            'Entreprise',
            'Service',
            'Date de passage',
            'Statut',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
