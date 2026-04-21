<?php

namespace Database\Seeders;

use App\Models\FileAttente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileattenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       FileAttente::create([
        'date'=>'2026-03-29',
        'nb_client_restant'=>00,
        'nb_total'=>20,
        'statut'=>'fermee',
        'service_id'=>2
       ]);

        FileAttente::create([
        'date'=>'2026-04-20',
        'nb_client_restant'=>20,
        'nb_total'=>35,
        'statut'=>'ouverte',
        'service_id'=>2
       ]);

        FileAttente::create([
        'date'=>'2026-02-10',
        'nb_client_restant'=>00,
        'nb_total'=>35,
        'statut'=>'fermee',
        'service_id'=>2
       ]);

        FileAttente::create([
        'date'=>'2026-04-20',
        'nb_client_restant'=>15,
        'nb_total'=>35,
        'statut'=>'ouverte',
        'service_id'=>3
       ]);

        FileAttente::create([
        'date'=>'2026-03-15',
        'nb_client_restant'=>22,
        'nb_total'=>29,
        'statut'=>'en_pause',
        'service_id'=>3
       ]);

        FileAttente::create([
        'date'=>'2026-04-15',
        'nb_client_restant'=>00,
        'nb_total'=>22,
        'statut'=>'fermee',
        'service_id'=>3
       ]);
    }
}
