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
        if (!Schema::hasTable('publicadores')) {
            Schema::create('publicadores', function (Blueprint $table) {
                $table->id();
                $table->string('primeiroNome');
                $table->string('nomeMeio')->nullable();
                $table->string('sobrenome');
                $table->date('dataNascimento');
                $table->date('dataBatismo');
                $table->char('sexo');
                $table->json('privilegios');
                $table->foreignId('grupos_de_campo_id')->constrained('grupos_de_campo');
                $table->string('endereco');
                $table->string('telefone');
                $table->string('contatoEmergencia');
                $table->string('telContatoEmergencia');
                $table->boolean('contatoEmergenciaEhTj');
                $table->boolean('ativo')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicadores');
    }
};
