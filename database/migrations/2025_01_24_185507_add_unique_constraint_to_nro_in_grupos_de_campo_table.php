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
        Schema::table('grupos_de_campo', function (Blueprint $table) {
            $table->unique('nro'); // Adiciona a constraint única no campo 'nro'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupos_de_campo', function (Blueprint $table) {
            $table->dropUnique(['nro']); // Remove a constraint única caso a migration seja revertida

        });
    }
};
