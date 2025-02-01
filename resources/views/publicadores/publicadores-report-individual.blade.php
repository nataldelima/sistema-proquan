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
                    <td>{{ $publicadores->gruposDeCampo }}</td>
                </tr>
                <tr>
                    <th>Data de Nascimento:</th>
                    <td>{{ $publicadores->dataNascimento  }}</td>
                </tr>
                <tr>
                    <th>Data de Batismo:</th>
                    <td>{{ $publicadores->dataBatismo   }}</td>
                </tr>
            </table>
        </div>
    </div>
    @endif
    @endsection