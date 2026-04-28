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
            $table->enum('type', ['standard', 'vip'])->default('standard')->after('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files_attente', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
