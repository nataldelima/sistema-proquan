<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GruposDeCampoController;
use App\Http\Controllers\PublicadoresController;
use App\Http\Controllers\CongregacaoController;
use App\Models\GruposDeCampo;

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
    Route::get('/congregacao/create', [CongregacaoController::class, 'create'])->name('congregacao-create');
    Route::post('/congregacao/store', [CongregacaoController::class, 'store'])->name('congregacao-store');
    Route::get('/congregacao/show/{id}', [CongregacaoController::class, 'show'])->name('congregacao-show');
    Route::get('/congregacao/edit/{id}', [CongregacaoController::class, 'edit'])->name('congregacao-edit');
    Route::put('/congregacao/update/{id}', [CongregacaoController::class, 'update'])->name('congregacao-update');
    Route::get('/congregacao/destroy/{id}', [CongregacaoController::class, 'destroy'])->name('congregacao-delete');
    Route::get('/congregacao/gerar-pdf-individual/{id}', [CongregacaoController::class, 'gerarPDFIndividual'])->name('congregacao-pdf');
    Route::get('/congregacao/gerar-pdf', [CongregacaoController::class, 'gerarPDF'])->name('congregacao-all-pdf');


    //Rotas para operações com Grupos de Campo
    Route::get('/grupos-campo', [GruposDeCampoController::class, 'index'])->name('grupos-campo');
    Route::get('/grupos-campo/create', [GruposDeCampoController::class, 'create'])->name('grupos-campo-create');
    Route::post('/grupos-campo', [GruposDeCampoController::class, 'store'])->name('grupos-campo-store');
    Route::get('/grupos-campo/show/{id}', [GruposDeCampoController::class, 'show'])->name('grupos-campo-show');
    Route::get('/grupos-campo/edit/{id}', [GruposDeCampoController::class, 'edit'])->name('grupos-campo-edit');
    Route::put('/grupos-campo/update/{id}', [GruposDeCampoController::class, 'update'])->name('grupos-campo-update');
    Route::get('/grupos-campo/destroy/{id}', [GruposDeCampoController::class, 'destroy'])->name('grupos-campo-delete');
    Route::get('/grupos-campo/gerar-pdf-individual/{id}', [GruposDeCampoController::class, 'gerarPDFIndividual'])->name('grupos-campo-pdf');
    Route::get('/grupos-campo/gerar-pdf', [GruposDeCampoController::class, 'gerarPDF'])->name('grupos-campo-all-pdf');


    //Rotas para operações com Publicadores
    Route::get('/publicadores', [PublicadoresController::class, 'index'])->name('publicadores');
    Route::get('/publicadores/create', [PublicadoresController::class, 'create'])->name('publicadores-create');
    Route::post('/publicadores', [PublicadoresController::class, 'store'])->name('publicadores-store');
    Route::get('/publicadores/show/{id}', [PublicadoresController::class, 'show'])->name('publicadores-show');
    Route::get('/publicadores/edit/{id}', [PublicadoresController::class, 'edit'])->name('publicadores-edit');
    Route::put('/publicadores/update/{id}', [PublicadoresController::class, 'update'])->name('publicadores-update');
    Route::get('/publicadores/destroy/{id}', [PublicadoresController::class, 'destroy'])->name('publicadores-delete');
    Route::get('/publicadores/gerar-pdf-individual/{id}', [PublicadoresController::class, 'gerarPDFIndividual'])->name('publicadores-pdf');
    Route::get('/publicadores/gerar-pdf', [PublicadoresController::class, 'gerarPDF'])->name('publicadores-all-pdf');
});

require __DIR__ . '/auth.php';
