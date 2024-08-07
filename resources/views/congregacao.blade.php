@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-10">
        <h1>Dados da Congregação</h1>
    </div>
    <div class="col-2">
        <a href="congregacao/create" class="btn btn-primary text-end">Cadastrar</a>
    </div>
</div>



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
                <td>[numero]</td>
            </tr>
            <tr>
                <th>Nome:</th>
                <td>[numero]</td>
            </tr>
            <tr>
                <th>Endereço:</th>
                <td>[numero]</td>
            </tr>
            <tr>
                <th>Circuito:</th>
                <td>[numero]</td>
            </tr>
            <tr>
                <th>Supte de Circuito:</th>
                <td>[numero]</td>
            </tr>
            <tr>
                <th>Tel. do Supte de Circuito:</th>
                <td>[numero]</td>
            </tr>
        </table>

    </div>
</div>

@endif




@endsection