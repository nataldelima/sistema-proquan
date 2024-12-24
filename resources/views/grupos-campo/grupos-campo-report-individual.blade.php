@extends('layouts.main-print')
@section('content')
<div class="row m-3">

    @if (!isset($gruposDeCampo))
    <div class="alert alert-warning">
        Não existem dados para exibir!
    </div>
    @else
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <tr>
                    <th>Número: </th>
                    <td>{{ $gruposDeCampo->id }}</td>
                </tr>
                <tr>
                    <th>Nome:</th>
                    <td>{{ $gruposDeCampo->nome }}</td>
                </tr>
                <tr>
                    <th>Supte do Grupo:</th>
                    <td>{{ $gruposDeCampo->dirigente_id }}</td>
                </tr>
                <tr>
                    <th>Ajudante:</th>
                    <td>{{ $gruposDeCampo->ajudante_id }}</td>
                </tr>
            </table>
        </div>
    </div>
    @endif
    @endsection