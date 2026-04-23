<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        Ticket::insert([

            [
                'numero' => 1,
                'statut' => 'en_attente',
                'type' => 'normal',
                'jour_passage' => now(),
                'date_debut_traitement' => null,
                'date_fin_traitement' => null,
                'client_id' => 1,
                'service_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'numero' => 2,
                'statut' => 'en_cours',
                'type' => 'express',
                'jour_passage' => now(),
                'date_debut_traitement' => now(),
                'date_fin_traitement' => null,
                'client_id' => 1,
                'service_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'numero' => 3,
                'statut' => 'traite',
                'type' => 'vip',
                'jour_passage' => now(),
                'date_debut_traitement' => now()->subMinutes(20),
                'date_fin_traitement' => now(),
                'client_id' => 1,
                'service_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'numero' => 4,
                'statut' => 'annule',
                'type' => 'normal',
                'jour_passage' => now(),
                'date_debut_traitement' => null,
                'date_fin_traitement' => null,
                'client_id' => 1,
                'service_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }

}
