@extends('layouts/main')
@section('content')
<form action="{{route ('grupos-campo-store')}}" method="post">
    @csrf

    <div class="row m-3">
        <div class="col-4 my-1">
            <label for="nro">Congregação</label>
            <select name="congregacao" id="congregacao" class="form-select" aria-label="Small select example">
                @foreach ($congregacoes as $congregacao)
                <option value=" {{ $congregacao->id }}">{{ $congregacao->nome }}</option>
                @endforeach
            </select>


        </div>
        <div class="col-2 my-1">
            <label for="nro">Nro do grupo</label>
            <input type="number" class="form-control" id="nro" name="nro" min="1" value="{{ old('nro') }}" required>
        </div>
        <div class="col-6 my-1">
            <label for="nome">Nome do grupo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>
    </div>

    <div class="row m-3 border-bottom pb-3">

        <div class="col-6 my-1">
            <label for="nome">Dirigente</label>
            <input type="text" class="form-control" id="dirigente" name="dirigente" value="{{ old('dirigente') }}">
        </div>
        <div class="col-6 my-1">
            <label for="nome">Ajudante</label>
            <input type="text" class="form-control" id="ajudante" name="ajudante" value="{{ old('ajudante') }}">
        </div>
    </div>
    <div class="row m-3 text-center">
        <div class="col-12">
            <input type="submit" value="Salvar" class="btn btn-primary">

        </div>
    </div>
</form>

@endsection