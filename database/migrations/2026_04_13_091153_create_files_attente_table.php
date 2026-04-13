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
        Schema::create('files_attente', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('nb_client_restant');
            $table->integer('nb_total');
            $table->enum('statut', ['ouverte', 'fermee', 'en_pause']);
            $table->foreignId('service_id')
                   ->constrained('services')
                   ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files_attente');
    }
};
