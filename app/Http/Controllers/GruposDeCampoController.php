<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\GruposDeCampo;
use App\Models\Congregacao;

class GruposDeCampoController extends Controller
{
    public function index()
    {
        try {
            $gruposDeCampo = GruposDeCampo::all();
            $title = 'Grupos de Campo';
            $congregacoes = Congregacao::all();
            return view('grupos-campo', compact('gruposDeCampo', 'title', 'congregacoes'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('home')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }
    public function create()
    {

        try {
            $congregacoes = Congregacao::all();
            $dados = [
                'title' => 'Cadastrar Grupo de Campo',
                'gruposDeCampo' => null,

            ];

            return view('grupos-campo-create', compact('congregacoes', 'dados'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('grupos-campo')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(
                [
                    'id' => 'required|string|max:255',
                    'congregacao_id' => 'required|exists:congregacoes,id',
                ],
                [
                    'id.required' => 'O campo ID é obrigatório.',
                    'id.string' => 'O campo ID deve ser uma string.',
                    'id.max' => 'O campo ID não pode ter mais de 255 caracteres.',
                    'congregacao_id.required' => 'O campo Congregação é obrigatório.',
                    'congregacao_id.exists' => 'A congregação selecionada não existe.',
                ]
            );
            GruposDeCampo::create($validatedData);
            return redirect()->route('grupos-campo')->with('success', 'Grupo de Campo cadastrado com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('grupos-campo')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }
}
