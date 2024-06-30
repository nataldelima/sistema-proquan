<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('grupos_de_campo', function (Blueprint $table) {
            $table->foreign('dirigente_id')->references('id')->on('publicadores');
            $table->foreign('ajudante_id')->references('id')->on('publicadores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupos_de_campo', function (Blueprint $table) {
            $table->dropForeign('dirigente_id');
            $table->dropForeign('ajudante_id');
        });
    }
};
