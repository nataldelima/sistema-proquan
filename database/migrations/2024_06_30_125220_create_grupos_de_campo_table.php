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
        if (!Schema::hasTable('grupos_de_campo')) {


            Schema::create('grupos_de_campo', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('congregacao_id');
                $table->unsignedBigInteger('dirigente_id');
                $table->unsignedBigInteger('ajudante_id');
                $table->timestamps();

                // Foreign key constraints
                $table->foreign('congregacao_id')->references('id')->on('congregacao');
                $table->foreign('dirigente_id')->references('id')->on('publicadores');
                $table->foreign('ajudante_id')->references('id')->on('publicadores');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos_de_campo');
    }
};
