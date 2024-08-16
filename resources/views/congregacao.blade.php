@extends('layouts.main')
@section('content')
    <div class="row m-3">
        <div class="col-10">
            <h1>{{ $title }}</h1>
        </div>
        <div class="col-2">
            <a href="congregacao/create" class="btn btn-primary text-center p-3"> <i class="bi bi-pencil-square"></i>
                Cadastrar</a>
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
                    <tr>
                        <th>Número</th>
                        <th>Nome da congregação</th>
                        <th class="text-end">Ações</th>
                    </tr>
                    @foreach ($congregacoes as $congregacao)
                        <tr>
                            <td><a style="text-decoration: none"
                                    href="{{ route('congregacao-show', ['id' => Crypt::encrypt($congregacao->id)]) }}">{{ $congregacao->id }}</a>
                            </td>

                            <td><a style="text-decoration: none"
                                    href="{{ route('congregacao-show', ['id' => Crypt::encrypt($congregacao->id)]) }}">{{ $congregacao->nome }}</a>
                            </td>

                            <td class="text-end">

                                <a href="{{ route('congregacao-show', ['id' => Crypt::encrypt($congregacao->id)]) }}"
                                    class="btn btn-warning mx-2"><i class="bi bi-card-list"></i>
                                    Visualizar</a>
                                <a href="{{ route('congregacao-edit', ['id' => Crypt::encrypt($congregacao->id)]) }}"
                                    class="btn btn-dark mx-2"><i class="bi bi-pencil-square"></i> Editar</a>
                                <button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{ $congregacao->id }}"><i class="bi bi-x-circle"></i>
                                    Apagar</button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop{{ $congregacao->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel{{ $congregacao->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Excluir
                                                    {{ $congregacao->nome }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4 class="mb-5">Confirma a exclusão dos dados abaixo?</h4>
                                                <div class="text-start">
                                                    <b>Nro:</b> {{ $congregacao->id }}<br />
                                                    <b>Nome da congregação:</b> {{ $congregacao->nome }}<br />
                                                    <b>Endereço:</b> {{ $congregacao->endereco }}
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Não</button>
                                                <a href="{{ route('congregacao-delete', ['id' => Crypt::encrypt($congregacao->id)]) }}"
                                                    class="btn btn-danger">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
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
