@extends('layouts.main-print')
@section('content')
<div class="row m-3">

    @if (!isset($publicadores))
    <div class="alert alert-warning">
        Não existem dados para exibir!
    </div>
    @else
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <tr>
                    <th colspan="4">
                        {{ $publicadores->primeiroNome." ".$publicadores->nomeMeio." ".$publicadores->sobrenome }}
                    </th>
                <tr>

                    <th>Data de Nascimento</th>
                    <th>Data de Batismo</th>
                    <th>Ativo</th>
                    <th>Sexo</th>

                </tr>
                <tr>

                    <td>{{ Carbon\Carbon::parse($publicadores->dataNascimento)->format('d/m/Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($publicadores->dataBatismo)->format('d/m/Y')    }}</td>
                    <td>{{ $publicadores->ativo ? 'Sim' : 'Nao' }}</td>
                    <td>{{$publicadores->sexo}}</td>

                </tr>

                <tr>
                    <th colspan="2">Grupo de campo</th>
                    <th colspan="2">Privilégios</th>

                </tr>
                <tr>
                    <td colspan="2">{{ $publicadores->grupoDeCampo->nome}}</td>
                    <td colspan="2">{{ $publicadores->privilegios ? implode(', ', $publicadores->privilegios) : ' '}}</td>

                </tr>
                <tr>
                    <th colspan="3">Endereço</th>
                    <th>Telefone</th>
                </tr>
                <tr>
                    <td colspan="3">
                        {{$publicadores->endereco}}
                    </td>
                    <td>
                        {{ $publicadores->telefone_formatted }}
                    </td>
                </tr>

                <tr>
                    <th colspan="2">Contato de Emergência</th>
                    <th>Telefone do Contato de Emergência</th>
                    <th>Contato é TJ</th>
                </tr>
                <tr>
                    <td colspan="2"> {{$publicadores->contatoEmergencia}}</td>
                    <td> {{ $publicadores->tel_contato_emergencia_formatted }}</td>
                    <td> {{ $publicadores->contatoEmergenciaEhTj ? 'Sim' : 'Nao' }}</td>
                </tr>
            </table>
        </div>
    </div>
    @endif
    @endsection
