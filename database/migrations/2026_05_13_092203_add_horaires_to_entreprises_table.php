<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ajouter le nouveau champ horaires
        Schema::table('entreprises', function (Blueprint $table) {
            $table->json('horaires')->nullable()->after('jour_ouv');
        });

        // Migrer les données existantes vers le nouveau format
        $entreprises = DB::table('entreprises')->get();
        
        foreach ($entreprises as $entreprise) {
            $joursOuverture = json_decode($entreprise->jour_ouv, true) ?? [];
            $heureOuv = $entreprise->heure_ouv;
            $heureFerm = $entreprise->heure_ferm;
            
            $horaires = [];
            $joursSemaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            
            foreach ($joursSemaine as $jour) {
                if (in_array($jour, $joursOuverture)) {
                    // Jour ouvert avec une plage horaire
                    $horaires[$jour] = [
                        'ferme' => false,
                        'plages' => [
                            [
                                'debut' => $heureOuv,
                                'fin' => $heureFerm
                            ]
                        ]
                    ];
                } else {
                    // Jour fermé
                    $horaires[$jour] = [
                        'ferme' => true,
                        'plages' => []
                    ];
                }
            }
            
            DB::table('entreprises')
                ->where('id', $entreprise->id)
                ->update(['horaires' => json_encode($horaires)]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropColumn('horaires');
        });
    }
};
