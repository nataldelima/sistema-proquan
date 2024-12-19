@extends('layouts.main-print')
@section('content')

@if(isset($gruposDeCampo))

@foreach($gruposDeCampo as $grupo)

<table class="table table-bordered table-dark">
    <thead>
        <tr>
            <th> Congregação:</th>
            <th>
                {{$grupo->congregacao_id}}
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Nome do Grupo:</th>
            <td>{{$grupo->nome}}</td>
        </tr>
        <tr>
            <th>Supte do Grupo:</th>
            <td>{{$grupo->dirigente_id}}</td>

        </tr>
        <tr>
            <th>Ajudante:</th>
            <td>{{$grupo->ajudante_id}}</td>
        </tr>
    </tbody>
</table>
@endforeach
<div style="page-break-after: always;">
    <div style="position:fixed; bottom:0; width:100%;">
        <div style="text-align:right">
            <p>Emitido em {{date('d/m/y h:i:s')}}</p>
        </div>
    </div>
</div>

@endif

@endsection