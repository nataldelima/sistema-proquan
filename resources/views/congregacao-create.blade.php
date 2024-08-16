@extends('layouts/main')
@section('content')
    <h1>{{ $title }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" id="msg" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('congregacao-store') }}" method="post">
        @csrf
        <div class="row m-3">
            <div class="col-4">
                <label for="nro">Número</label>
                <input type="text" name="id" id="id" class="form-control">
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
                <input type="text" name="supteCircuito" id="supteCircuito" class="form-control">
            </div>
            <div class="col-3">
                <label for="fone_supte">Fone do Supte</label>
                <input type="text" name="telefoneSupteCircuito" id="telefoneSupteCircuito" class="form-control">
            </div>
        </div>
        <div class="row m-3 text-center">
            <div class="col-12">
                <input type="submit" value="Salvar" class="btn btn-primary">

            </div>
        </div>

    </form>
@endsection
<script>
    setTimeout(function() {
        var alert = document.getElementById('msg');
        if (alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000); // O alerta desaparecerá após 5 segundos
</script>
