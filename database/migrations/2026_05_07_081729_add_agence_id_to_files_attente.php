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
        Schema::table('files_attente', function (Blueprint $table) {
            $table->foreignId('agence_id')->nullable()
                ->constrained('agences')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files_attente', function (Blueprint $table) {
            $table->dropForeign('files_attente_agence_id_foreign');
            $table->dropColumn('agence_id');
        });
    }
};
