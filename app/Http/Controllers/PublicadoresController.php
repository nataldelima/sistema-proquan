<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicadores;
use App\Models\GruposDeCampo;
use App\Models\Congregacao;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;

class PublicadoresController extends Controller
{

    public function index()
    {

        try {
            $title = 'Lista de Publicadores';
            $publicadores = Publicadores::orderBy('primeiroNome')->get();
            $gruposDeCampo = GruposDeCampo::all();
            return view('publicadores.publicadores', compact('publicadores', 'title', 'gruposDeCampo'));
        } catch (\Exception $e) {
            Log::error('Erro ao listar publicadores: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'Não foi possível carregar a lista de publicadores.');
        }
    }


    public function create()
    {

        try {
            $dados = [
                'title' => 'Cadastrar Publicadores',
                'publicador' => null,
                'gruposDeCampo' => GruposDeCampo::all(),
            ];

            return view('publicadores.publicadores-create', $dados);
        } catch (\Exception $e) {
            Log::error('Erro ao criar publicador: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'Não foi possível carregar a lista de publicadores.');
        }
    }

    public function store(Request $request)
    {

        try {

            $validadeData = $request->validate(
                [
                    'primeiroNome' => 'required|string|max:255',
                    'nomeMeio' => 'nullable|string|max:255',
                    'sobrenome' => 'required|string|max:255',
                    'dataNascimento' => 'required|date',
                    'dataBatismo' => 'required|date',
                    'sexo' => 'required|in:M,F',
                    'privilegios' => 'nullable|array',
                    'privilegios.*' => 'string',
                    'grupos_de_campo_id' => 'required|exists:grupos_de_campo,id',
                    'endereco' => 'required|string|max:255',
                    'telefone' => 'required|string|max:255',
                    'contatoEmergencia' => 'required|string|max:255',
                    'telContatoEmergencia' => 'required|string|max:255',
                    'contatoEmergenciaEhTj' => 'required|boolean',
                    'ativo' => 'required|boolean',
                ],
                [
                    'primeiroNome.required' => 'O campo Primeiro Nome é obrigatório.',
                    'sobrenome.required' => 'O campo Sobrenome é obrigatório.',
                    'dataNascimento.required' => 'O campo Data de Nascimento é obrigatório.',
                    'dataBatismo.required' => 'O campo Data de Batismo é obrigatório.',
                    'sexo.required' => 'O campo Sexo é obrigatório.',
                    'endereco.required' => 'O campo Endereço é obrigatório.',
                    'telefone.required' => 'O campo Telefone é obrigatório.',
                    'contatoEmergencia.required' => 'O campo Contato de Emergência é obrigatório.',
                    'telContatoEmergencia.required' => 'O campo Telefone de Contato de Emergência é obrigatório.',
                    'contatoEmergenciaEhTj.required' => 'O campo Contato de Emergência é obrigatório.',
                    'ativo.required' => 'O campo Ativo é obrigatório.',
                    'grupos_de_campo_id.required' => 'O campo Grupo de Campo é obrigatório.',
                    'grupos_de_campo_id.exists' => 'O Grupo de Campo selecionado não existe.',
                ]
            );

            // Converter o array de privilégios para string JSON antes de salvar
            if (isset($validadeData['privilegios'])) {
                $validadeData['privilegios'] = json_encode($validadeData['privilegios']);
            } else {

                $validadeData['privilegios'] = json_encode([]);
            }


            Publicadores::create($validadeData);
            return redirect()->route('publicadores')->with('success', 'Publicador criado com sucesso.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Erro ao criar publicador: ' . $e->getMessage());
            return redirect()->route('publicadores-create')->with('error', 'Não foi possível criar o publicador.');
        } catch (\Exception $e) {
            Log::error('Erro ao criar publicador: ' . $e->getMessage());
            return redirect()->route('publicadores-create')->with('error', 'Não foi possível criar o publicador.');
        }
    }

    //Função show
    public function show($id)
    {
        try {
            $publicador = Publicadores::where('id', Crypt::decrypt($id))->first();
            $dados = [
                'title' => 'Visualizar Publicador',
                'publicadores' => $publicador
            ];

            return view('publicadores.publicadores-show', $dados);
        } catch (\Exception $e) {
            Log::error('Erro ao mostrar publicador: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'Não foi possível mostrar o publicador.');
        }
    }
    //Função edit
    public function edit($id)
    {
        try {
            $publicador = Publicadores::where('id', Crypt::decrypt($id))->first();
            $dados = [
                'title' => 'Editar Publicador',
                'publicador' => $publicador,
                'gruposDeCampo' => GruposDeCampo::all()
            ];

            return view('publicadores.publicadores-create', $dados);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Erro ao descriptografar o ID: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'ID inválido.');
        } catch (\Exception $e) {
            Log::error('Erro ao editar publicador: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'Não foi possível editar o publicador.');
        }
    }

    //Função update
    public function update(Request $request, $id)
    {
        try {

            $validateData = $request->validate(

                [
                    'primeiroNome' => 'required|string|max:255',
                    'nomeMeio' => 'nullable|string|max:255',
                    'sobrenome' => 'required|string|max:255',
                    'dataNascimento' => 'required|date',
                    'dataBatismo' => 'required|date',
                    'sexo' => 'required|in:M,F',
                    'privilegios' => 'nullable|array',
                    'privilegios.*' => 'string',
                    'grupos_de_campo_id' => 'required|exists:grupos_de_campo,id',
                    'endereco' => 'required|string|max:255',
                    'telefone' => 'required|string|max:255',
                    'contatoEmergencia' => 'required|string|max:255',
                    'telContatoEmergencia' => 'required|string|max:255',
                    'contatoEmergenciaEhTj' => 'required|boolean',
                    'ativo' => 'required|boolean',
                ],
                [
                    'primeiroNome.required' => 'O campo Primeiro Nome é obrigatório.',
                    'sobrenome.required' => 'O campo Sobrenome é obrigatório.',
                    'dataNascimento.required' => 'O campo Data de Nascimento é obrigatório.',
                    'dataBatismo.required' => 'O campo Data de Batismo é obrigatório.',
                    'sexo.required' => 'O campo Sexo é obrigatório.',
                    'endereco.required' => 'O campo Endereço é obrigatório.',
                    'telefone.required' => 'O campo Telefone é obrigatório.',
                    'contatoEmergencia.required' => 'O campo Contato de Emergência é obrigatório.',
                    'telContatoEmergencia.required' => 'O campo Telefone de Contato de Emergência é obrigatório.',
                    'contatoEmergenciaEhTj.required' => 'O campo Contato de Emergência é obrigatório.',
                    'ativo.required' => 'O campo Ativo é obrigatório.',
                ]
            );

            $publicador = Publicadores::findOrFail($id);

            $validateData['privilegios'] = $request->input('privilegios', []);

            $publicador->update($validateData);
            return redirect()->route('publicadores')->with('success', 'Publicador atualizado com sucesso.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Erro ao descriptografar o ID: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'ID inválido.');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar publicador: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'Não foi possível atualizar o publicador.');
        }
    }

    // Função destroy
    public function destroy($id)
    {
        try {
            Publicadores::where('id', Crypt::decrypt($id))->delete();
            return redirect()->route('publicadores')->with('success', 'Publicador excluído com sucesso.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Erro ao descriptografar o ID: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'ID inválido.');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir publicador: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'Não foi possível excluir o publicador.');
        }
    }

    public function gerarPDFIndividual($id)
    {
        try {
            $publicadores = Publicadores::where('id', Crypt::decrypt($id))->first();

            $data = [
                'title' => 'Dados do Publicador',
                'publicadores' => $publicadores,

            ];


            $pdf = PDF::loadView('publicadores.publicadores-report-individual', $data);

            return $pdf->download($publicadores->primeiroNome . ' ' . $publicadores->sobrenome . '.pdf');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Erro ao descriptografar o ID: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'ID inválido.');
        } catch (\Exception $e) {
            Log::error('Erro ao gerar PDF: ' . $e->getMessage());
            return redirect()->route('publicadores')->with('error', 'Não foi possível gerar o PDF.');
        }
    }

    public function gerarPDF()
    {
        try {
            $publicadores = Publicadores::with('grupodecampo.congregacao')->orderBy('primeiroNome')->get();
            $title = 'Lista de Publicadores';
            $data = [
                'title' => $title,
                'publicadores' => $publicadores,
                'congregacao' => Congregacao::all(),
                'gruposDeCampo' => GruposDeCampo::all(),
            ];
            $pdf = PDF::loadView('publicadores.publicadores-report-all', $data);

            return $pdf->download('Lista de Publicadores.pdf');
        } catch (\Exception $e) {
            Log::error('Erro ao gerar PDF de Publicadores: ' . $e->getMessage());
            return response()->json([
                'error' => 'Houve um erro ao gerar o PDF. Por favor, tente novamente mais tarde.'
            ], 500);
        }
    }
}
