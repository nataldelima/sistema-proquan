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
            $table->bigInteger('nro')->unsigned()->nullable()->after('id'); // Cria o campo 'nro' após o campo 'id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupos_de_campo', function (Blueprint $table) {
            $table->dropColumn('nro'); // Remove o campo 'nro' se a migration for revertida
        });
    }
};
