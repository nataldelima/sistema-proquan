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
            $gruposDeCampo = GruposDeCampo::all();
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
            $dados = [
                'title' => 'Cadastrar Grupo de Campo',
                'gruposDeCampo' => null,
                'congregacoes' => Congregacao::all(),
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
                ],
                [
                    'congregacao_id.required' => 'O campo Congregação é obrigatório.',
                    'congregacao_id.string' => 'O campo Congregação deve ser uma string.',
                    'congregacao_id.max' => 'O campo Congregação não pode ter mais de 255 caracteres.',
                    'nome.required' => 'O campo nome do grupo é obrigatório.',
                    'nome.string' => 'O campo nome do grupo deve ser uma string.',
                    'nome.max' => 'O campo nome do grupo não pode ter mais de 255 caracteres.',
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
                ],
                [
                    'congregacao_id.required' => 'O campo Congregação é obrigatório.',
                    'congregacao_id.string' => 'O campo Congregação deve ser uma string.',
                    'congregacao_id.max' => 'O campo Congregação não pode ter mais de 255 caracteres.',
                    'nome.required' => 'O campo nome do grupo é obrigatório.',
                    'nome.string' => 'O campo nome do grupo deve ser uma string.',
                    'nome.max' => 'O campo nome do grupo não pode ter mais de 255 caracteres.',
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
            GruposDeCampo::where('id', Crypt::decrypt($id))->delete();
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
            return $pdf->download('grupos-campo-report-' . $gruposDeCampo->id . '.pdf');
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
            $gruposDeCampo = GruposDeCampo::all();
            $title = 'Grupos de Campo';
            $data = [
                'title' => $title,
                'gruposDeCampo' => $gruposDeCampo
            ];

            $pdf = PDF::loadView('grupos-campo.grupos-campo-report-all', $data);
            return $pdf->download('grupos-campo-report-all.pdf');
        } catch (\Exception $e) {
            Log::error('Erro ao gerar PDF de grupos de campo: ' . $e->getMessage());
            return response()->json([
                'error' => 'Houve um erro ao gerar o PDF. Por favor, tente novamente mais tarde.'
            ], 500);
        }
    }
}
