@extends('layouts.main-print')
@section('content')


    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th style="width: 25%">Nome</th>
                <th style="width: 30%">Endereço</th>
                <th style="width: 20%">Telefone</th>
                <th style="width: 25%">Contato de Emergência</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($publicadores) && $publicadores->count())
                @foreach ($publicadores as $publicador)
                    <tr>
                        <td>{{ $publicador->primeiroNome . ' ' . $publicador->nomeMeio . ' ' . $publicador->sobrenome ?? 'N/A' }}
                        </td>
                        <td>{{ $publicador->endereco ?? 'N/A' }}</td>
                        <td>{{ $publicador->telefone_formatted ?? 'N/A' }}</td>
                        <td><b>{{ $publicador->contatoEmergenciaEhTj ? 'TJ' : 'Não TJ' }}:</b>
                            {{ $publicador->contatoEmergencia }}<br />{{ $publicador->tel_contato_emergencia_formatted }}

                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
