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
            $table->unsignedBigInteger('dirigente_id')->nullable()->change();
            $table->unsignedBigInteger('ajudante_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupos_de_campo', function (Blueprint $table) {
            $table->unsignedBigInteger('dirigente_id')->nullable(false)->change();
            $table->unsignedBigInteger('ajudante_id')->nullable(false)->change();
        });
    }
};
