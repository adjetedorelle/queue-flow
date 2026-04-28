<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 50)->unique();
            $table->enum('statut', ['en_attente', 'en_cours', 'traite', 'annule']);
            $table->string('type')->default('normal');
            $table->datetime('jour_passage');
            $table->datetime('date_debut_traitement')->nullable();
            $table->datetime('date_fin_traitement')->nullable();
            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->onDelete('cascade');
            $table->foreignId('service_id')
                  ->constrained('services')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};