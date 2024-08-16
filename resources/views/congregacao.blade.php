@extends('layouts.main')
@section('content')
    <div class="row m-3">
        <div class="col-10">
            <h1>{{ $title }}</h1>
        </div>
        <div class="col-2">
            <a href="congregacao/create" class="btn btn-primary text-end">Cadastrar</a>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="msg" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    @if (!isset($congregacoes) || count($congregacoes) == 0)
        <div class="alert alert-warning">
            Não existem dados para exibir!
        </div>
    @else
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    @foreach ($congregacoes as $congregacao)
                        <tr>
                            <th>Número: </th>
                            <td>{{ $congregacao->id }}</td>
                        </tr>
                        <tr>
                            <th>Nome:</th>
                            <td>{{ $congregacao->nome }}</td>
                        </tr>
                        <tr>
                            <th>Endereço:</th>
                            <td>{{ $congregacao->endereco }}</td>
                        </tr>
                        <tr>
                            <th>Circuito:</th>
                            <td>{{ $congregacao->circuito }}</td>
                        </tr>
                        <tr>
                            <th>Supte de Circuito:</th>
                            <td>{{ $congregacao->supteCircuito }}</td>
                        </tr>
                        <tr>
                            <th>Tel. do Supte de Circuito:</th>
                            <td>{{ $congregacao->telefoneSupteCircuito }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
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
