@extends('layouts.main-print')
@section('content')

@if(isset($gruposDeCampo))

@php
$ultimaCongregacao = null;
@endphp

@foreach($gruposDeCampo as $grupo)


{{-- Verifica se a congregação mudou --}}
@if($grupo->Congregacao->nome !== $ultimaCongregacao)

{{-- Quebra de página antes de um novo agrupamento, exceto no início --}}
@if($ultimaCongregacao !== null)
<div style="page-break-after: always;"></div>
@endif

{{-- Define a nova congregação --}}
@php
$ultimaCongregacao = $grupo->Congregacao->nome;
@endphp

{{-- Cabeçalho do novo grupo de congregação --}}
<table class="table table-bordered table-dark">
    <thead>
        <tr>
            <th colspan="2">Congregação: {{ $grupo->Congregacao->nome }}</th>
        </tr>
    </thead>
</table>
@endif

{{-- Informações do grupo dentro do agrupamento --}}
<table class="table table-bordered table-dark">
    <tbody>
        <tr>
            <th style="width:30%">Grupo: </th>
            <td>{{$grupo->nro.' - '.$grupo->nome}}</td>
        </tr>
        <tr>
            <th style="width:30%">Supte do Grupo:</th>
            <td>{{$grupo->dirigente_id}}</td>

        </tr>
        <tr>
            <th style="width:30%">Ajudante:</th>
            <td>{{$grupo->ajudante_id}}</td>
        </tr>
    </tbody>
</table>

@endforeach
<div style="position:fixed; bottom:0; width:100%;">
    <div style="text-align:right">
        <p>Emitido em {{date('d/m/y h:i:s')}}</p>
    </div>
</div>

@endif

@endsection