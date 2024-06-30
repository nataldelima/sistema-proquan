<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Publicador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Criar Publicador</h2>
            </div>
        </div>


        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('publicadores.store') }}" method="POST">
            @csrf
            <div class="row">

                <div class="form-group col-3 my-1">
                    <label for="primeiroNome">Primeiro Nome</label>
                    <input type="text" class="form-control" id="primeiroNome" name="primeiroNome"
                        value="{{ old('primeiroNome') }}" required>
                </div>

                <div class="form-group col-6 my-1">
                    <label for="nomeMeio">Nome do Meio</label>
                    <input type="text" class="form-control" id="nomeMeio" name="nomeMeio" value="{{ old('nomeMeio') }}">
                </div>

                <div class="form-group col-3 my-1">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" name="sobrenome"
                        value="{{ old('sobrenome') }}" required>
                </div>
            </div>
            <div class="row">

                <div class="form-group col-5 my-1">
                    <label for="dataNascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento"
                        value="{{ old('dataNascimento') }}" required>
                </div>

                <div class="form-group col-5 my-1">
                    <label for="dataBatismo">Data de Batismo</label>
                    <input type="date" class="form-control" id="dataBatismo" name="dataBatismo"
                        value="{{ old('dataBatismo') }}" required>
                </div>

                <div class="form-group col-2 my-1">
                    <label for="sexo">Sexo</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="sexo_m" name="sexo" value="M" {{
                            old('sexo')=='M' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="sexo_m">Masculino</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="sexo_f" name="sexo" value="F" {{
                            old('sexo')=='F' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="sexo_f">Feminino</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-10">
                    <label for="privilegios">Privilégios</label><br>
                    <div class="form-check form-check-inline col-2">
                        <input class="form-check-input" type="checkbox" id="privilegio1" name="privilegios[]"
                            value="ancião" {{ is_array(old('privilegios')) && in_array('ancião', old('privilegios'))
                            ? 'checked' : '' }}>
                        <label class="form-check-label" for="privilegio1">Ancião</label>
                    </div>
                    <div class="form-check form-check-inline  col-4">
                        <input class="form-check-input" type="checkbox" id="privilegio2" name="privilegios[]"
                            value="servo ministerial" {{ is_array(old('privilegios')) && in_array('servo ministerial',
                            old('privilegios')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="privilegio2">Servo Ministerial</label>
                    </div>
                    <div class="form-check form-check-inline  col-4">
                        <input class="form-check-input" type="checkbox" id="privilegio3" name="privilegios[]"
                            value="pioneiro regular" {{ is_array(old('privilegios')) && in_array('pioneiro regular',
                            old('privilegios')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="privilegio3">Pioneiro Regular</label>
                    </div>
                </div>
                <div class="form-group col-2 my-1">
                    <label for="ativo">Ativo: </label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="ativo_s" name="ativo" value="1" {{
                            old('ativo')=='1' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="ativo_s">Sim</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="ativo_n" name="ativo" value="F" {{
                            old('ativo')=='N' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="ativo_n">Não</label>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-8">
                    <label for="endereco">Endereço</label>
                    <textarea class="form-control" id="endereco" name="endereco" value="{{ old('endereco') }}"
                        required></textarea>
                </div>

                <div class="form-group col-4">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}"
                        required>
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group col-3">
                    <label for="contatoEmergencia">Contato de Emergência</label>
                    <input type="text" class="form-control" id="contatoEmergencia" name="contatoEmergencia"
                        value="{{ old('contatoEmergencia') }}" required>
                </div>

                <div class="form-group col-4">
                    <label for="telContatoEmergencia">Telefone do Contato de Emergência</label>
                    <input type="text" class="form-control" id="telContatoEmergencia" name="telContatoEmergencia"
                        value="{{ old('telContatoEmergencia') }}" required>
                </div>

                <div class="form-group col-4">
                    <label for="contatoEmergenciaEhTj">O contato de emergência é Testemunha de Jeová?</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="contatoEmergenciaEhTj_s"
                            name="contatoEmergenciaEhTj" value="S" {{ old('contatoEmergenciaEhTj')=='1' ? 'checked' : ''
                            }} required>
                        <label class="form-check-label" for="contatoEmergenciaEhTj_m">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="contatoEmergenciaEhTj_n"
                            name="contatoEmergenciaEhTj" value="N {{
                            old('contatoEmergenciaEhTj')=='0' ? 'checked' : '' }} required">
                        <label class="form-check-label" for="contatoEmergenciaEhTj_f">Não</label>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</body>

</html>
