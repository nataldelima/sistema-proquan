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
        Schema::table('congregacao', function (Blueprint $table) {
            $table->string('telefoneSupteCircuito');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('congregacao', function (Blueprint $table) {
            $table->dropColumn('telefoneSupteCircuito');
        });
    }
};
