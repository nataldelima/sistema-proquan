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


@if (isset($congregacao) && $congregacao != null)
<form action="{{ route('congregacao-update', $congregacao->id) }}" method="post">
    @method('PUT')
    @csrf
    <input type="hidden" name="campo_cript" value={{ Crypt::encrypt($congregacao->id) }}>
    @else
    <form action="{{ route('congregacao-store') }}" method="post">
        @csrf
        @endif


        <div class="row m-3">
            <div class="col-4">
                <label for="id">Número</label>
                <input type="text" name="id" id="id" class="form-control"
                    value="{{ old('id') ?? ($congregacao->id ?? '') }}">
            </div>
            <div class="col-8">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control"
                    value="{{ old('nome') ?? ($congregacao->nome ?? '') }}">
            </div>
        </div>
        <div class=" row m-3">
            <div class="col">
                <label for="endereco">Endereço</label>
                <textarea name="endereco" id="endereco" class="form-control">{{ old('endereco') ?? ($congregacao->endereco ?? '') }}</textarea>
            </div>
        </div>
        <div class="row m-3 border-bottom pb-3">
            <div class="col-3">
                <label for="circuito">Circuito</label>
                <input type="text" name="circuito" id="circuito" class="form-control"
                    value="{{ old('circuito') ?? ($congregacao->circuito ?? '') }}">
            </div>
            <div class="col-6">
                <label for="supteCircuito">Superintendente de Circuito</label>
                <input type="text" name="supteCircuito" id="supteCircuito" class="form-control"
                    value="{{ old('supteCircuito') ?? ($congregacao->supteCircuito ?? '') }}">
            </div>
            <div class="col-3">
                <label for="telefoneSupteCircuito">Fone do Supte</label>
                <input type="number" name="telefoneSupteCircuito" id="telefoneSupteCircuito" class="form-control"
                    value="{{ old('telefoneSupteCircuito') ?? ($congregacao->telefoneSupteCircuito ?? '') }}">
            </div>
        </div>
        <div class="row m-3 text-center">
            <div class="col-12">
                <input type="submit" value="Salvar" class="btn btn-dark m-3 p-3">
                <a href="{{ route('congregacao') }}" class="btn btn-danger m-3 p-3">Cancelar</a>

            </div>
        </div>

    </form>
    @endsection
    <script>
        // Fechar mensagem depois de 5 segundos
        setTimeout(function() {
            var alert = document.getElementById('msg');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000); // O alerta desaparecerá após 5 segundos
    </script>
