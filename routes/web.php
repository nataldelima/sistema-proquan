<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GruposDeCampoController;
use App\Http\Controllers\PublicadoresController;
use App\Http\Controllers\CongregacaoController;

Route::get('/', function () {
    return "<h1>Bem vindo ao PROQUAN</h1>";
});

//Rotas para operações com Congregação
Route::get('/congregacao', [CongregacaoController::class, 'index'])->name('congregacao');
Route::get('/congregacao/create', [CongregacaoController::class, 'create'])->name('congregacao-dados');
Route::post('/congregacao/store', [CongregacaoController::class, 'store'])->name('congregacao-store');
Route::get('/congregacao/show/{id}', [CongregacaoController::class, 'show'])->name('congregacao-show');
Route::get('/congregacao/edit/{id}', [CongregacaoController::class, 'edit'])->name('congregacao-edit');
Route::put('/congregacao/update/{id}', [CongregacaoController::class, 'update'])->name('congregacao-update');
Route::get('/congregacao/destroy/{id}', [CongregacaoController::class, 'destroy'])->name('congregacao-delete');


//Rotas para operações com Grupos de Campo
Route::get('/grupos-campo/create', [GruposDeCampoController::class, 'create'])->name('grupos-campo-create');
Route::post('/grupos-campo', [GruposDeCampoController::class, 'store'])->name('grupos-campo-store');


//Rotas para operações com Publicadores
Route::get('/publicadores/create', [PublicadoresController::class, 'create'])->name('publicadores-create');
Route::post('/publicadores', [PublicadoresController::class, 'store'])->name('publicadores-store');
