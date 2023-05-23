@extends('layout.clean-layout')

@section('tittle','Notefy - Home')

@push('font')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
@endpush

@section('content')
    <div style="padding-top:238px;" class="flex-column">
        <div style="font-family: Poppins">
        
            <div class="d-flex m-5">
                <img class="align-self-center" width="600" height="150" src="{{asset('img/notefy-logo-blue.png')}}" alt="notefy">
                <div class="align-self-center text-center">
                    <h4 style="color:#0b61be" class=" px-5 mb-4">
                        Notefy é um aplicativo web em Laravel para gerenciar tarefas e anotações. Com recursos de criação, edição e integração com o Google OAuth, o Notefy ajuda os usuários a organizar tarefas diárias e fazer anotações importantes. O aplicativo também permite o envio de e-mails com base nas tarefas e anotações. O Notefy foi desenvolvido para praticar habilidades em Laravel e possui licença MIT.
                    </h4>

                    @guest
                        <a style="background: #0b61be" class="btn btn-light border-0 fs-4 p-2 text-white" href="{{route("auth.login")}}">Login</a>
                        <a style="background: #0b61be" class="btn btn-light border-0 fs-4 p-2 text-white" href="{{route("auth.register")}}">Registre-se</a>
                    @endguest

                    @auth
                        Você está autenticado.<br><br>
                        <a style="background: #0b61be" class="btn btn-light border-0 fs-4 p-2 text-white" href="{{route("works.dashboard")}}">Painel</a>
                        <a style="background: #0b61be" class="btn btn-light border-0 fs-4 p-2 text-white" href="{{route("auth.logout")}}">Sair</a>
                    @endauth

                </div>
            </div>
            
             {{-- <p style="color:#0b61be">
                Notefy é um aplicativo web desenvolvido em Laravel para gerenciamento de tarefas e anotações. Ele foi criado com o objetivo de ajudar os usuários a manterem suas tarefas organizadas e fazer anotações pessoais de forma prática e eficiente.
                Com o Notefy, os usuários podem criar listas de tarefas, editar tarefas existentes, marcar tarefas como concluídas e excluí-las quando não forem mais necessárias. Além disso, o aplicativo permite que os usuários criem anotações pessoais, fornecendo um espaço para registrar ideias, pensamentos, lembretes e qualquer outra informação relevante.
                O aplicativo possui uma integração com o Google OAuth para autenticação de usuários, permitindo que eles façam login em suas contas do Google de forma segura e conveniente.
                Uma funcionalidade adicional do Notefy é a capacidade de enviar e-mails com base nas tarefas e anotações dos usuários. Isso pode ser útil para compartilhar informações ou receber lembretes por e-mail relacionados a tarefas específicas.
                É importante notar que o Notefy não foi desenvolvido com foco em layout responsivo, mas sim para oferecer uma oportunidade de prática das habilidades em Laravel. Portanto, a interface do usuário pode ser mais adequada para uso em desktops ou laptops.
                O projeto Notefy foi licenciado sob a licença MIT, o que significa que os usuários têm permissão para utilizar, modificar e distribuir o código fonte, desde que sejam mantidos os direitos autorais e a licença original.
            </p> --}}

            <div class="m-5 p-5 rounded">
                <h3 style="color:#0b61be" class="mb-5"><b>Algumas tecnologias do Notefy...</b></h3>
                <div style="margin-right: 8rem; margin-left: 8rem" class="d-flex justify-content-between align-items-center">
                    <img width="200" height="140" src="{{asset('img/api.png')}}" alt="api">
                    <img width="140" src="{{asset('img/mailtrap.png')}}" alt="mailtrap">
                    <img width="140" src="{{asset('img/laravel-plain.png')}}" alt="laravel">
                    <img width="170" src="{{asset('img/bootstrap-plain.png')}}" alt="bootstrap">
                </div>
            </div>
    
        </div>
    
        <footer style="height: 100px; color: #242424" class="d-grid b-light align-items-center">
            <div class="text-end px-5">
                <p class="m-0">
                    Made by 
                    <a style="color: #242424" href="https://www.github.com/vdanviel">
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
    
    </div>
@endsection