<!DOCTYPE html>
<html class="h-100" lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
    {{--bootstrap css--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <title>@yield('tittle')</title>
</head>

<body style="color: #2f2f2f">
    
    <header>

        <nav style="background: #ffffff" class="navbar navbar-expand-lg">

            {{--navbar--}}
            <div class="container-fluid">

                {{--logo--}}
                <a href="{{route('hello')}}">
                    <img src="{{asset('img/notefy-logo-blue.png')}}" alt="Notefy" width="100">
                </a>

                {{--mobile links--}}
                <button class="navbar-toggler border border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
              
                {{--desktop or greater links--}}
                <div class="collapse navbar-collapse justify-content-lg-end" id="navbarNav">

                    <ul class="navbar-nav">

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{route('hello')}}">Home</a>
                            </li>
                            {{--login link. muda se estiver na pagina login--}}
                            @if(request()->path() == "login")
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{route('auth.register')}}">Registre-se</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{route('auth.login')}}">Entrar</a>
                                </li>
                            @endif
                                
                        @endguest

                        @auth
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{route('works.dashboard')}}">Painel</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Suas anotações</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Suas Tarefas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Perfil</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{route('auth.register')}}" onclick="return confirm('Você realmente deseja sair ?')">Sair</a>
                            </li>
                        @endauth

                        <li class="nav-item">
                            <a class="nav-link" href="#">Sobre</a>
                        </li>
                    </ul>

                </div>

            </div>

          </nav>

    </header>

    <main class="d-flex flex-direction-column min-vh-100">@yield('content')</main>

    <footer style="height: 100px;" class="d-grid b-light align-items-center">
        <div class="text-end px-5">
            <p class="m-0">
                Made by 
                <a style="color: #2f2f2f" href="https://www.github.com/vdanviel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                    </svg>
                    vdanviel
                </a>
            </p>
            <p class="m-0">
                Notefy © 2023
            </p>
        </div>
    </footer>

    {{--bootstrap js--}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>