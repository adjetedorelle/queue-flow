<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    public function run()
    {
       Entreprise::create([
                'nom_ent' => 'Banque Atlantique',
                'bio' => 'Services bancaires',
                'adresse' => 'Cotonou',
                'statut' => 'actif',
                'heure_ouv' => '08:00:00',
                'heure_ferm' => '17:00:00',
                'jour_ouv' => 'lundi-vendredi',
                'admin_id' => 1,
                'image'=> 'banque'
       ]);
    }
}
