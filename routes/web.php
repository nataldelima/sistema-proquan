<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GruposDeCampoController;
use App\Http\Controllers\PublicadoresController;
use App\Http\Controllers\CongregacaoController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Rotas para operações com Congregação
    Route::get('/congregacao', [CongregacaoController::class, 'index'])->name('congregacao');
    Route::get('/congregacao/create', [CongregacaoController::class, 'create'])->name('congregacao-dados');
    Route::post('/congregacao/store', [CongregacaoController::class, 'store'])->name('congregacao-store');
    Route::get('/congregacao/show/{id}', [CongregacaoController::class, 'show'])->name('congregacao-show');
    Route::get('/congregacao/edit/{id}', [CongregacaoController::class, 'edit'])->name('congregacao-edit');
    Route::put('/congregacao/update/{id}', [CongregacaoController::class, 'update'])->name('congregacao-update');
    Route::get('/congregacao/destroy/{id}', [CongregacaoController::class, 'destroy'])->name('congregacao-delete');
    Route::get('/congregacao/gerar-pdf-individual/{id}', [CongregacaoController::class, 'gerarPDFIndividual'])->name('gerar-pdf-individual');
    Route::get('/congregacao/gerar-pdf', [CongregacaoController::class, 'gerarPDF'])->name('gerar-pdf');


    //Rotas para operações com Grupos de Campo
    Route::get('/grupos-campo/create', [GruposDeCampoController::class, 'create'])->name('grupos-campo-create');
    Route::post('/grupos-campo', [GruposDeCampoController::class, 'store'])->name('grupos-campo-store');


    //Rotas para operações com Publicadores
    Route::get('/publicadores/create', [PublicadoresController::class, 'create'])->name('publicadores-create');
    Route::post('/publicadores', [PublicadoresController::class, 'store'])->name('publicadores-store');
});

require __DIR__ . '/auth.php';
