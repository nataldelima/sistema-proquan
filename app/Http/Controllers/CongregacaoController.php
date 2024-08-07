<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congregacao;

class CongregacaoController extends Controller
{
    public function index()
    {
        $congregacoes = Congregacao::all();
        return view('congregacao', ['congregacoes' => $congregacoes]);
    }
    public function create()
    {

        return view('congregacao-create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nro' => 'required',
            'nome' => 'required',
            'endereco' => 'required',
            'circuito' => 'required',
            'supte_circuito' => 'required',
            'tel_supte_circuito' => 'required'
        ]);
        $congregacao = new Congregacao();
        $congregacao->nro = $request->nro;
        $congregacao->nome = $request->nome;
        $congregacao->endereco = $request->endereco;
        $congregacao->circuito = $request->circuito;
        $congregacao->supte_circuito = $request->supte_circuito;
        $congregacao->tel_supte_circuito = $request->tel_supte_circuito;
        $congregacao->save();
        return redirect()->route('congregacao.index')->with('success', 'Congregação cadastrada com sucesso!');
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
