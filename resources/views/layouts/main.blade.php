<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Publicador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.min.css') }}">
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand me-5" href="/">
                    PROQUAN
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Home</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Congregação</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route ('congregacao')}}">Dados da Congregação</a></li>
                                <li><a class="dropdown-item" href="{{route ('grupos-campo')}}">Grupos de Campo</a></li>
                                <li><a class="dropdown-item" href="/publicadores/create">Publicadores</a></li>
                                <li><a class="dropdown-item" href="#">Esboços de Discursos Públicos</a>
                                </li>
                            </ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Reuniões</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Meio de Semana</a></li>
                                <li><a class="dropdown-item" href="#">Fim de Semana</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Designações Mecânicas</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Indicadores</a></li>
                                <li><a class="dropdown-item" href="#">Volantes, Som e Palco</a></li>
                                <li><a class="dropdown-item" href="#">Limpeza do Salão do Reino</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Ministério de Campo</a>
                            <ul class="dropdown-menu">
                                <li>Testemunho Público</li>
                                <li><a class="dropdown-item" href="#">Participantes</a></li>
                                <li><a class="dropdown-item" href="#">Equipamentos</a></li>
                                <li><a class="dropdown-item" href="#">Dias e horários</a></li>
                                <li><a class="dropdown-item" href="#">Locais de trabalho</a></li>

                                <li>
                                    <hr>
                                </li>
                                <li>Serviço de Campo</li>
                                <li><a class="dropdown-item" href="grupos.php">Grupos de Campo</a></li>
                                <li><a class="dropdown-item" href="#">Dirigentes</a></li>
                                <li><a class="dropdown-item" href="#">Dias e horários</a></li>
                                <li><a class="dropdown-item" href="#">Locais de saída</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Informações de Login -->
                    <ul class="navbar-nav ms-auto mb-2 mb-md-0 me-5 pe-5">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Olá, <b>{{ Auth::user()->name }}</b></a>
                            <ul class="dropdown-menu">

                                <li><x-responsive-nav-link :href="route('profile.edit')" class="dropdown-item">
                                        {{ __('Profile') }}
                                    </x-responsive-nav-link></li>
                                <li>
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="dropdown-item">
                                            {{ __('Dashboard') }}
                                        </x-responsive-nav-link>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-responsive-nav-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="dropdown-item">
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </form>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </div>
            </div>
            </div>
        </nav>
    </header>


    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">

            </div>
        </div>

        @yield('content')

    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>