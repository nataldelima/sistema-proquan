<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congregacao;

class CongregacaoController extends Controller
{
    public function index()
    {
        $congregacoes = Congregacao::all();
        $title = 'Dados da Congregação';
        return view('congregacao', compact('congregacoes', 'title'));
    }
    public function create()
    {

        $title = 'Cadastrar Congregação';
        return view('congregacao-create', compact('title'));
    }
    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'id' => 'required|unique:congregacao,id',
                'nome' => 'required',
                'endereco' => 'required',
                'circuito' => 'required',
                'supteCircuito' => 'required',
                'telefoneSupteCircuito' => 'required'
            ],
            [
                'id.required' => 'O campo Nº é obrigatório',
                'id.unique' => 'O Nº informado já existe. Por favor, insira um número diferente.',
                'nome.required' => 'O campo Nome é obrigatório',
                'endereco.required' => 'O campo Endereço é obrigatório',
                'circuito.required' => 'O campo Circuito é obrigatório',
                'supteCircuito.required' => 'O campo Supte Circuito é obrigatório',
                'telefoneSupteCircuito.required' => 'O campo Telefone Supte Circuito é obrigatório'
            ]
        );
        Congregacao::create($validateData);
        return redirect()->route('congregacao')->with('success', 'Congregação cadastrada com sucesso!');
    }
    public function edit($id)
    {
        return view('congregacao.edit', ['id' => $id]);
    }
    public function update(Request $request, $id)
    {
        return $request->all();
    }
}
