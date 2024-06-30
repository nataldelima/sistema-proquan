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
        Schema::table('publicadores', function (Blueprint $table) {
            $table->foreign('grupos_de_campo_id')->references('id')->on('grupos_de_campo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publicadores', function (Blueprint $table) {
            $table->dropForeign('grupos_de_campo_id');
        });
    }
};
