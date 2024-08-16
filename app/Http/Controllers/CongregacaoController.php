<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congregacao;
use Illuminate\Support\Facades\Crypt;

class CongregacaoController extends Controller
{
    public function index()
    {
        $congregacoes = Congregacao::all();
        $title = 'Lista de Congregações';
        return view('congregacao', compact('congregacoes', 'title'));
    }
    public function create()
    {
        $dados = [
            'title' => 'Cadastrar Congregação',
            'congregacao' => null,
        ];
        return view('congregacao-dados', $dados);
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
    public function show($id)
    {
        $congregacao = Congregacao::where('id', Crypt::decrypt($id))->first();
        $dados =  [
            'title' => 'Visualizar Congregação',
            'congregacao' => $congregacao
        ];
        return view('congregacao-show', $dados);
    }


    public function edit($id)
    {
        $congregacao = Congregacao::where('id', Crypt::decrypt($id))->first();
        $dados =  [
            'title' => 'Editar Congregação',
            'congregacao' => $congregacao
        ];


        return view('congregacao-dados', $dados);
    }
    public function update(Request $request, $id)
    {
        $validateData = $request->validate(
            [
                'id' => 'required',
                'nome' => 'required',
                'endereco' => 'required',
                'circuito' => 'required',
                'supteCircuito' => 'required',
                'telefoneSupteCircuito' => 'required'
            ],
            [
                'id.required' => 'O campo Nº é obrigatório',
                'nome.required' => 'O campo Nome é obrigatório',
                'endereco.required' => 'O campo Endereço é obrigatório',
                'circuito.required' => 'O campo Circuito é obrigatório',
                'supteCircuito.required' => 'O campo Supte Circuito é obrigatório',
                'telefoneSupteCircuito.required' => 'O campo Telefone Supte Circuito é obrigatório'
            ]
        );
        $congregacao = Congregacao::findOrFail($id);
        $congregacao->update($validateData);
        return redirect()->route('congregacao')->with('success', 'Congregação atualizada com sucesso!');
    }
    // rota de exclusão de dados
    public function destroy($id)
    {
        Congregacao::where('id', Crypt::decrypt($id))->delete();
        return redirect()->route('congregacao')->with('success', 'Congregação excluída com sucesso!');
    }
}
