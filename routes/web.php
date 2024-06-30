<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PublicadoresController;

Route::get('/publicadores/create', [PublicadoresController::class, 'create'])->name('publicadores-create');
Route::post('/publicadores', [PublicadoresController::class, 'store'])->name('publicadores-store');

