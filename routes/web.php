<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GruposDeCampoController;
use App\Http\Controllers\PublicadoresController;
use App\Http\Controllers\CongregacaoController;

Route::get('/', function () {
    return "<h1>Bem vindo ao PROQUAN</h1>";
});


Route::get('/congregacao', [CongregacaoController::class, 'index'])->name('congregacao');
Route::get('/congregacao/create', [CongregacaoController::class, 'create'])->name('congregacao-create');
Route::post('/congregacao/store', [CongregacaoController::class, 'store'])->name('congregacao-store');

Route::get('/grupos-campo/create', [GruposDeCampoController::class, 'create'])->name('grupos-campo-create');
Route::post('/grupos-campo', [GruposDeCampoController::class, 'store'])->name('grupos-campo-store');

Route::get('/publicadores/create', [PublicadoresController::class, 'create'])->name('publicadores-create');
Route::post('/publicadores', [PublicadoresController::class, 'store'])->name('publicadores-store');
