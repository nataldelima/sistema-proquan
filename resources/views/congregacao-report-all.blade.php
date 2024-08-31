@extends('layouts.main-print')
@section('content')

@if(isset($congregacoes))

@foreach($congregacoes as $congregacao)

<table class="table table-bordered table-dark">
    <thead>
        <tr>
            <th> Congregação:</th>
            <th colspan="2">
                {{$congregacao->nome}}
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Endereço:</th>
            <td colspan="2">{{$congregacao->endereco}}</td>
        </tr>
        <tr>
            <th>Circuito:</th>
            <th>Supte de Circuito:</th>
            <th>Tel. Supte de Circuito:</th>
        </tr>
        <tr>
            <td>{{$congregacao->circuito}}</td>
            <td>{{$congregacao->supteCircuito}}</td>
            <td>{{$congregacao->telefoneSupteCircuito}}</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="text-align:right">Emitido em</td>
        </tr>
    </tfoot>
</table>
@endforeach
@endif

@endsection
