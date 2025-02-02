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
                    <th>Nome: </th>
                    <td>{{ $publicadores->primeiroNome." ".$publicadores->nomeMeio." ".$publicadores->sobrenome }}</td>
                </tr>
                <tr>
                    <th>Grupo de campo:</th>
                    <td>{{ $publicadores->grupoDeCampo->nome}}</td>
                </tr>
                <tr>
                    <th>Data de Nascimento:</th>
                    <td>{{ Carbon\Carbon::parse($publicadores->dataNascimento)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Data de Batismo:</th>
                    <td>{{ Carbon\Carbon::parse($publicadores->dataBatismo)->format('d/m/Y')    }}</td>
                </tr>
            </table>
        </div>
    </div>
    @endif
    @endsection