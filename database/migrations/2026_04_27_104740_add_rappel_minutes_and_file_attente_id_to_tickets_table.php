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
        Schema::table('tickets', function (Blueprint $table) {
            $table->integer('rappel_minutes')->nullable()->after('date_fin_traitement');
            $table->foreignId('file_attente_id')->nullable()->constrained('files_attente')->after('rappel_minutes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['file_attente_id']);
            $table->dropColumn(['rappel_minutes', 'file_attente_id']);
        });
    }
};
