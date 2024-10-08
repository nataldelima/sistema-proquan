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
        if (!Schema::hasTable('congregacao')) {
            Schema::create('congregacao', function (Blueprint $table) {
                $table->unsignedBigInteger('id')->primary();
                $table->string('nome');
                $table->tinytext('endereco');
                $table->string('circuito');
                $table->string('supteCircuito');
                $table->string('telefoneSupteCircuito');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('congregacao');
    }
};
