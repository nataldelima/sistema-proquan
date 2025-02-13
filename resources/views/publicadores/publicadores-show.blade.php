@extends('layouts.main')
@section('content')
<div class="row m-3">
    <div class="col-10">
        <h1>{{ $title }}</h1>
    </div>

    @if (!isset($publicadores))

    <div class="alert alert-warning">
        Não existem dados para exibir!
    </div>
    @else
    <div class="row">
        <div class="col">
            <table class="table table-striped mt-5 align-middle">
                <tr>
                    <th class="text-center fs-3" colspan="6">{{ $publicadores->primeiroNome.' '.$publicadores->nomeMeio.' '.$publicadores->sobrenome  }}</th>
                </tr>
                <tr>
                    <th class="fs-5">Endereço</th>
                    <td colspan="3">{{ $publicadores->endereco }}</td>
                    <th class="fs-5">Ativo</th>
                    <td colspan="3">{{ $publicadores->ativo ? 'Sim' : 'Nao' }}</td>
                </tr>
                <tr>
                    <th class="fs-5">Telefone</th>
                    <td>{{ $publicadores->telefone_formatted }}</td>
                    <th class="fs-5">Data de Nascimento</th>
                    <td>{{ date('d/m/Y', strtotime($publicadores->dataNascimento)) }}</td>

                    <th class="fs-5">Data de Batismo</th>
                    <td>{{ date('d/m/Y', strtotime($publicadores->dataBatismo)) }}</td>
                </tr>
                <tr>
                    <th class="fs-5">Sexo</th>
                    <td>{{ $publicadores->sexo }}</td>

                    <th class="fs-5">Grupo de Campo</th>
                    <td>{{ $publicadores->grupoDeCampo->nome }}</td>
                    <th class="fs-5">Privilégios</th>
                    <td>{{ $publicadores->privilegios ? implode(', ', $publicadores->privilegios) : ' '}}</td>
                </tr>
                <tr>
                    <th class="fs-5">Contato de Emergência</th>
                    <td>{{ $publicadores->contatoEmergencia }}</td>
                    <th class="fs-5">Telefone do Contato de Emergência</th>
                    <td>{{ $publicadores->tel_contato_emergencia_formatted }}</td>
                    <th class="fs-5">É Testemunha de Jeová?</th>
                    <td>{{ $publicadores->contatoEmergenciaEhTj ? 'Sim' : 'Nao' }}</td>
                </tr>

            </table>
            <div class="row mt-5">
                <div class="text-center">
                    <a href="{{route ('publicadores')}}" class="btn btn-dark m-3 p-3 text-center" title="Voltar"><i class="bi bi-arrow-left-square fs-1"></i></a>

                    <a href="{{route ('publicadores-pdf', ['id' => Crypt::encrypt($publicadores->id)])}}" class="btn btn-dark m-3 p-3 text-center" title="Exportar registro para arquivo PDF"><i class="bi bi-file-pdf fs-1"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endsection
