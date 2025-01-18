@extends('layouts.main')
@section('content')
<div class="row m-3">
    <div class="col-9 text-start">
        <h1>{{ $title }}</h1>
    </div>
    <div class="col-3 text-end">
        <a href="{{route('publicadores-create')}}" class="btn btn-primary text-center p-3" title="Cadastrar nova congregação"> <i class="bi bi-pencil-square fs-3"></i>
        </a>

        <a href="{{route('publicadores-all-pdf') }}" class="btn btn-primary text-center p-3" title="Exportar dados para arquivo em formato PDF"> <i class="bi bi-filetype-pdf fs-3"></i>
        </a>
    </div>


</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" id="msg" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


@if (!isset($publicadores) || count($publicadores) == 0)
<div class="alert alert-warning">
    Não existem dados para exibir!
</div>
@else
<div class="row">
    <div class="col">
        <table class="table table-striped">
            <tr>
                <th colspan="3">Publicadores </th>
            </tr>
            <tr>
                <th>Nome do publicador</th>
                <th>Grupo de campo</th>
                <th class="text-end">Ações</th>
            </tr>
            @foreach ($publicadores as $publicador)
            <tr>
                <td><a style="text-decoration: none"
                        href="{{ route('publicadores-show', ['id' => Crypt::encrypt($publicador->id)]) }}">{{ $publicador->primeiroNome }} {{$publicador->nomeMeio}} {{$publicador->sobrenome}}</a>
                </td>

                <td><a style="text-decoration: none"
                        href="{{ route('publicadores-show', ['id' => Crypt::encrypt($publicador->id)]) }}">{{$publicador->grupoDeCampo->nome}}</a>
                </td>

                <td class="text-end">

                    <a href="{{ route('publicadores-show', ['id' => Crypt::encrypt($publicador->id)]) }}"
                        class="btn btn-warning mx-2" title="Visualizar informações da publicador"><i class="bi bi-card-list fs-4"></i></a>
                    <a href="{{ route('publicadores-edit', ['id' => Crypt::encrypt($publicador->id)]) }}"
                        class="btn btn-dark mx-2" title="Editar informações de publicador"><i class="bi bi-pencil-square fs-4"></i> </a>
                    <button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop{{ $publicador->id }}" data-bs-placement="bottom"
                        title="Apagar registro de publicador"><i class="bi bi-x-circle fs-4"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{ $publicador->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel{{ $publicador->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Excluir
                                        {{ $publicador->primeiroNome }}
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="mb-5">Confirma a exclusão dos dados abaixo?</h4>
                                    <div class="text-start">
                                        <b>Nome:</b> {{ $publicador->primeiroNome}} {{$publicador->nomeMeio}} {{$publicador->sobrenome}}<br />
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Não</button>
                                    <a href="{{ route('publicadores-delete', ['id' => Crypt::encrypt($publicador->id)]) }}"
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
