@extends('layouts/main')
@section('content')
<form action="">
    @csrf
    <div class="row m-3">
        <div class="col-4">
            <label for="nro">Número</label>
            <input type="text" name="nro" id="nro" class="form-control">
        </div>
        <div class="col-8">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control">
        </div>
    </div>
    <div class="row m-3">
        <div class="col">
            <label for="endereco">Endereço</label>
            <textarea name="endereco" id="endereco" class="form-control"></textarea>
        </div>
    </div>
    <div class="row m-3 border-bottom pb-3">
        <div class="col-3">
            <label for="circuito">Circuito</label>
            <input type="text" name="circuito" id="circuito" class="form-control">
        </div>
        <div class="col-6">
            <label for="supte_circuito">Superintendente de Circuito</label>
            <input type="text" name="supte_circuito" id="supte_circuito" class="form-control">
        </div>
        <div class="col-3">
            <label for="fone_supte">Fone do Supte</label>
            <input type="text" name="fone_supte" id="fone_supte" class="form-control">
        </div>
    </div>
    <div class="row m-3 text-center">
        <div class="col-12">
            <input type="submit" value="Salvar" class="btn btn-primary">

        </div>
    </div>

</form>

@endsection