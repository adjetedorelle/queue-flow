<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
          'libelle' => 'Dépôt',
          'entreprise_id' => 1,
          'temps_estime' => 30,
        ]);

        Service::create([
          'libelle' => 'Retrait',
          'entreprise_id' => 1,
          'temps_estime' => 20,
        ]);

        Service::create([
          'libelle' => 'Achat',
          'entreprise_id' => 1,
          'temps_estime' => 45,
        ]);
    }
}
