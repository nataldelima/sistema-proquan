@extends('layouts.main-print')
@section('content')
<div class="row m-3">

    @if (!isset($congregacao))
    <div class="alert alert-warning">
        Não existem dados para exibir!
    </div>
    @else
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <tr>
                    <th>Número: </th>
                    <td>{{ $congregacao->id }}</td>
                </tr>
                <tr>
                    <th>Nome:</th>
                    <td>{{ $congregacao->nome }}</td>
                </tr>
                <tr>
                    <th>Endereço:</th>
                    <td>{{ $congregacao->endereco }}</td>
                </tr>
                <tr>
                    <th>Circuito:</th>
                    <td>{{ $congregacao->circuito }}</td>
                </tr>
                <tr>
                    <th>Supte de Circuito:</th>
                    <td>{{ $congregacao->supteCircuito }}</td>
                </tr>
                <tr>
                    <th>Tel. do Supte de Circuito:</th>
                    <td>{{ $congregacao->telefoneSupteCircuito }}</td>
                </tr>

            </table>
        </div>
    </div>
    @endif
    @endsection
