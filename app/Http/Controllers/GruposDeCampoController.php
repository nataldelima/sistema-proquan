<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GruposDeCampoController extends Controller
{
    public function create()
    {
        return view('grupos-campo-create');
    }
    public function store()
    {
        return view('grupos-campo-store');
    }
}
