@extends('layouts.main-print')
@section('content')

@if(isset($congregacoes))

@foreach($congregacoes as $congregacao)

<table>
    <thead>
        <tr>
            <th>
                {{$congregacao->nome}}
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="3">Endereço:</th>
            <td>{{$congregacao->endereco}}</td>
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
            <td colspan="3">Emitido em</td>
        </tr>
    </tfoot>
</table>
@endforeach
@endif

@endsection
