<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congregacao;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class CongregacaoController extends Controller
{
    public function index()
    {
        try {
            $congregacoes = Congregacao::all();
            $title = 'Lista de Congregações';
            return view('congregacao', compact('congregacoes', 'title'));
        } catch (\Exception $e) {
            Log::error('Erro ao listar congregações: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Não foi possível carregar a lista de congregações.');
        }
    }
    public function create()
    {

        try {
            $dados = [
                'title' => 'Cadastrar Congregação',
                'congregacao' => null,
            ];
            return view('congregacao-dados', $dados);
        } catch (\Exception $e) {
            Log::error('Erro ao carregar o formulário de criação: ' . $e->getMessage());
            return redirect()->route('congregacao')->with('error', 'Não foi possível carregar o formulário.');
        }
    }
    public function store(Request $request)
    {

        try {

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
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar congregação: ' . $e->getMessage());
            return redirect()->route('congregacao')->with('error', 'Não foi possível cadastrar a congregação.');
        }
    }
    public function show($id)
    {

        try {


            $congregacao = Congregacao::where('id', Crypt::decrypt($id))->first();
            $dados =  [
                'title' => 'Visualizar Congregação',
                'congregacao' => $congregacao
            ];
            return view('congregacao-show', $dados);
        } catch (\Exception $e) {
            Log::error('Erro ao visualizar congregação: ' . $e->getMessage());
            return redirect()->route('congregacao')->with('error', 'Não foi possível carregar os dados da congregação.');
        }
    }


    public function edit($id)
    {
        try {
            $congregacao = Congregacao::where('id', Crypt::decrypt($id))->first();
            $dados =  [
                'title' => 'Editar Congregação',
                'congregacao' => $congregacao
            ];

            return view('congregacao-dados', $dados);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Erro ao descriptografar o ID: ' . $e->getMessage());
            return redirect()->route('congregacao')->with('error', 'ID inválido.');
        } catch (\Exception $e) {
            Log::error('Erro ao carregar formulário de edição: ' . $e->getMessage());
            return redirect()->route('congregacao')->with('error', 'Não foi possível carregar os dados da congregação.');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // validação dos dados

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
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar congregação: ' . $e->getMessage());
            return redirect()->route('congregacao')->with('error', 'Não foi possível atualizar a congregação.');
        }
    }
    // rota de exclusão de dados
    public function destroy($id)
    {
        try {
            Congregacao::where('id', Crypt::decrypt($id))->delete();
            return redirect()->route('congregacao')->with('success', 'Congregação excluída com sucesso!');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Erro ao descriptografar o ID: ' . $e->getMessage());
            return redirect()->route('congregacao')->with('error', 'ID inválido.');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir congregação: ' . $e->getMessage());
            return redirect()->route('congregacao')->with('error', 'Não foi possível excluir a congregação.');
        }
    }
}
