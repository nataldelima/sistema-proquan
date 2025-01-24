<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\GruposDeCampo;
use App\Models\Congregacao;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;

class GruposDeCampoController extends Controller
{
    public function index()
    {
        try {
            $gruposDeCampo = GruposDeCampo::orderBy('nro')->get();
            $title = 'Grupos de Campo';
            $congregacoes = Congregacao::all();
            return view('grupos-campo.grupos-campo', compact('gruposDeCampo', 'title', 'congregacoes'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('home')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }
    public function create()
    {
        try {

            // Busca todos os números existentes em ordem crescente
            $numerosExistentes = GruposDeCampo::orderBy('nro', 'asc')->pluck('nro')->toArray();

            // Calcula o menor número disponível
            $proximoNro = 1;
            foreach ($numerosExistentes as $nro) {
                if ($nro == $proximoNro) {
                    $proximoNro++;
                } else {
                    break;
                }
            }


            $dados = [
                'title' => 'Cadastrar Grupo de Campo',
                'gruposDeCampo' => null,
                'congregacoes' => Congregacao::all(),
                'proximoNro' => $proximoNro,
            ];

            return view('grupos-campo.grupos-campo-create', $dados);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('grupos-campo.grupos-campo')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(
                [
                    'congregacao_id' => 'required|string|max:255',
                    'nome' => 'required|string|max:255',
                    'nro' => 'required|integer|unique:grupos_de_campo|max:255',
                ],
                [
                    'congregacao_id.required' => 'O campo Congregação é obrigatório.',
                    'congregacao_id.string' => 'O campo Congregação deve ser uma string.',
                    'congregacao_id.max' => 'O campo Congregação não pode ter mais de 255 caracteres.',
                    'nome.required' => 'O campo nome do grupo é obrigatório.',
                    'nome.string' => 'O campo nome do grupo deve ser uma string.',
                    'nome.max' => 'O campo nome do grupo não pode ter mais de 255 caracteres.',
                    'nro.required' => 'O campo número é obrigatório.',
                    'nro.integer' => 'O campo número deve ser um número inteiro.',
                    'nro.max' => 'O campo número não pode ter mais de 255 caracteres.',
                    'nro.unique' => 'O número já está em uso.',

                ]
            );
            GruposDeCampo::create($validatedData);
            return redirect()->route('grupos-campo')->with('success', 'Grupo de Campo cadastrado com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('grupos-campo')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }



    public function show($id)
    {
        try {
            $gruposDeCampo = GruposDeCampo::where('id', Crypt::decrypt($id))->first();
            $dados = [
                'title' => 'Visualizar Grupo de Campo',
                'gruposDeCampo' => $gruposDeCampo,
                'congregacoes' => Congregacao::all(),
            ];
            return view('grupos-campo.grupos-campo-show', $dados);
        } catch (\Exception $e) {
            Log::error('Erro ao visualizar grupo de campo: ' . $e->getMessage());
            return redirect()->route('grupos-campo')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }
    public function edit($id)
    {
        try {
            $gruposDeCampo = GruposDeCampo::where('id', Crypt::decrypt($id))->first();
            $dados = [
                'title' => 'Editar Grupo de Campo',
                'grupoDeCampo' => $gruposDeCampo,
                'congregacoes' => Congregacao::all(),
            ];
            return view('grupos-campo.grupos-campo-create', $dados);
        } catch (\Exception $e) {
            Log::error('Erro ao editar grupo de campo: ' . $e->getMessage());
            return redirect()->route('grupos-campo')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate(
                [
                    'congregacao_id' => 'required|string|max:255',
                    'nome' => 'required|string|max:255',
                    'nro' => 'required|integer|unique:grupos_de_campo|max:255',

                ],
                [
                    'congregacao_id.required' => 'O campo Congregação é obrigatório.',
                    'congregacao_id.string' => 'O campo Congregação deve ser uma string.',
                    'congregacao_id.max' => 'O campo Congregação não pode ter mais de 255 caracteres.',
                    'nome.required' => 'O campo nome do grupo é obrigatório.',
                    'nome.string' => 'O campo nome do grupo deve ser uma string.',
                    'nome.max' => 'O campo nome do grupo não pode ter mais de 255 caracteres.',
                    'nro.required' => 'O campo número é obrigatório.',
                    'nro.integer' => 'O campo número deve ser um número inteiro.',
                    'nro.max' => 'O campo número não pode ter mais de 255 caracteres.',
                    'nro.unique' => 'O número já está em uso.',

                ]
            );
            $gruposDeCampo = GruposDeCampo::findOrFail($id);
            $gruposDeCampo->update($validatedData);
            return redirect()->route('grupos-campo')->with('success', 'Grupo de Campo atualizado com sucesso.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar grupo de campo: ' . $e->getMessage());
            return redirect()->route('grupos-campo')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }

    public function destroy($id)
    {
        try {

            // Descriptografa o ID
            $decryptedId = Crypt::decrypt($id);

            // Busca o grupo a ser deletado
            $grupo = GruposDeCampo::findOrFail($decryptedId);

            // Salva o número do grupo que será deletado
            $nroDeletado = $grupo->nro;

            // Deleta o grupo
            $grupo->delete();
            // Atualiza os números dos grupos com nro maior que o deletado
            GruposDeCampo::where('nro', '>', $nroDeletado)
                ->orderBy('nro', 'asc')
                ->get()
                ->each(function ($grupo) {
                    $grupo->nro -= 1;
                    $grupo->save();
                });


            return redirect()->route('grupos-campo')->with('success', 'Grupo de Campo excluído com sucesso.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Erro ao descriptografar o ID: ' . $e->getMessage());
            return redirect()->route('grupos-campo')->with('error', 'ID inválido.');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir grupo de campo: ' . $e->getMessage());
            return redirect()->route('grupos-campo')->with('error', 'Não foi possível carregar a lista de grupos de campo.');
        }
    }


    public function gerarPDFIndividual($id)
    {
        try {
            $gruposDeCampo = GruposDeCampo::where('id', Crypt::decrypt($id))->first();
            $title = 'Grupos de Campo';
            $data = [
                'title' => $title,
                'gruposDeCampo' => $gruposDeCampo
            ];


            $pdf = PDF::loadView('grupos-campo.grupos-campo-report-individual', $data);
            return $pdf->download('Grupo de Campo ' . $gruposDeCampo->nro . ' - ' . $gruposDeCampo->nome . '.pdf');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Erro ao descriptografar o ID: ' . $e->getMessage());
            return redirect()->route('grupos-campo.grupos-campo')->with('error', 'ID inválido.');
        } catch (\Exception $e) {
            Log::error('Erro ao gerar PDF: ' . $e->getMessage());
            return redirect()->route('grupos-campo.grupos-campo')->with('error', 'Não foi possível gerar o PDF.');
        }
    }

    public function gerarPDF()
    {
        try {
            $gruposDeCampo = GruposDeCampo::orderBy('nro')->get();
            $title = 'Grupos de Campo';
            $data = [
                'title' => $title,
                'gruposDeCampo' => $gruposDeCampo
            ];

            $pdf = PDF::loadView('grupos-campo.grupos-campo-report-all', $data);
            return $pdf->download('Lista de Grupos de Campo.pdf');
        } catch (\Exception $e) {
            Log::error('Erro ao gerar PDF de grupos de campo: ' . $e->getMessage());
            return response()->json([
                'error' => 'Houve um erro ao gerar o PDF. Por favor, tente novamente mais tarde.'
            ], 500);
        }
    }
}
