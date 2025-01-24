@extends('layouts.main')
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

@if (isset($grupoDeCampo) && $grupoDeCampo != null)
<form action="{{ route('grupos-campo-update', $grupoDeCampo->id) }}" method="post">
    @method('PUT')
    @csrf
    <input type="hidden" name="campo_cript" value={{ Crypt::encrypt($grupoDeCampo->id) }}>
    @else
    <form action=" {{ route('grupos-campo-store') }}" method="post">
        @csrf
        @endif

        <div class="row m-3">
            <div class="col-5 my-1">
                <label for="congregacao_id">Congregação</label>
                <select name="congregacao_id" id="congregacao_id" class="form-select" aria-label="Small select example">

                    @foreach ($congregacoes as $congregacao)
                    <option value="{{ $congregacao->id }}"
                        {{ old('congregacao_id') ?? ($grupoDeCampo->congregacao_id ?? '') == $congregacao->id ? 'selected' : '' }}>
                        {{ $congregacao->nome }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-3 my-1">
                <label for="nome">Nro do grupo</label>
                <input type="number" class="form-control" id="nro" name="nro"
                    value="{{ old('nro') ?? ($grupoDeCampo->nro ?? $proximoNro) }}">
            </div>

            <div class="col-4 my-1">
                <label for="nome">Nome do grupo</label>
                <input type="text" class="form-control" id="nome" name="nome"
                    value="{{ old('nome') ?? ($grupoDeCampo->nome ?? '') }}">
            </div>
        </div>

        <div class=" row m-3 border-bottom pb-3">

            <div class="col-6 my-1">
                <label for="dirigente_id">Dirigente</label>
                <input type="text" class="form-control" id="dirigente_id" name="dirigente_id"
                    value="{{ old('dirigente_id') ?? ($grupo_campo->dirigente_id ?? '') }}">
            </div>
            <div class="col-6 my-1">
                <label for="ajudante_id">Ajudante</label>
                <input type="text" class="form-control" id="ajudante_id" name="ajudante_id"
                    value="{{ old('ajudante_id') ?? ($grupo_campo->ajudante_id ?? '') }}">
            </div>
        </div>
        <div class="row m-3 text-center">
            <div class="col-12">
                <input type="submit" value="Salvar" class="btn btn-dark m-3 p-3">
                <a href="{{ route('grupos-campo') }}" class="btn btn-danger m-3 p-3">Cancelar</a>

            </div>
        </div>
    </form>
    @endsection