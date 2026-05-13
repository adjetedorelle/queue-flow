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
        // D'abord, convertir les données existantes en JSON
        DB::statement("UPDATE entreprises SET jour_ouv = CASE 
            WHEN jour_ouv IS NULL OR jour_ouv = '' THEN '[]'
            WHEN JSON_VALID(jour_ouv) THEN jour_ouv
            ELSE CONCAT('[\"', jour_ouv, '\"]')
        END");

        // Puis changer le type de colonne
        Schema::table('entreprises', function (Blueprint $table) {
            $table->json('jour_ouv')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->string('jour_ouv')->change();
        });
    }
};
