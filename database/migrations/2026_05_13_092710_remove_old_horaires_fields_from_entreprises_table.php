<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropColumn(['heure_ouv', 'heure_ferm', 'jour_ouv']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->time('heure_ouv')->nullable();
            $table->time('heure_ferm')->nullable();
            $table->json('jour_ouv')->nullable();
        });
    }
};
