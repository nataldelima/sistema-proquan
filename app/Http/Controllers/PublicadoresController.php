<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicadores;

class PublicadoresController extends Controller
{
    public function create()
    {
        return view('publicadores-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'primeiroNome' => 'required|string|max:255',
            'nomeMeio' => 'nullable|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'dataNascimento' => 'required|date',
            'dataBatismo' => 'required|date',
            'sexo' => 'required|in:M,F',
            'privilegios' => 'nullable|array',
            'endereco' => 'required|string|max:255',
            'telefone' => 'required|string|max:255',
            'contatoEmergencia' => 'required|string|max:255',
            'telContatoEmergencia' => 'required|string|max:255',
            'contatoEmergenciaEhTj' => 'required|boolean',
            'ativo' => 'required|boolean',
        ]);

        $publicador = new Publicadores();
        $publicador->primeiroNome = $request->primeiroNome;
        $publicador->nomeMeio = $request->nomeMeio;
        $publicador->sobrenome = $request->sobrenome;
        $publicador->dataNascimento = $request->dataNascimento;
        $publicador->dataBatismo = $request->dataBatismo;
        $publicador->sexo = $request->sexo;
        $publicador->privilegios = json_encode($request->privilegios);
        $publicador->endereco = $request->endereco;
        $publicador->telefone = $request->telefone;
        $publicador->contatoEmergencia = $request->contatoEmergencia;
        $publicador->telContatoEmergencia = $request->telContatoEmergencia;
        $publicador->contatoEmergenciaEhTj = $request->contatoEmergenciaEhTj;
        $publicador->ativo = $request->ativo;
        $publicador->save();

        return redirect()->route('publicadores-create')->with('success', 'Publicador criado com sucesso.');
    }
}
