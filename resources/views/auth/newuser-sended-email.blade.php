@extends('layout.clean-layout')

@section('tittle', 'Notefy - Usuário autorizado.')

@push('font')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
@endpush

@section('content')
    
    <div class="d-flex flex-column align-items-center" style="font-family: Poppins" class="text-center">
        <img class="mb-5" width="300" src="{{asset('img/notefy-logo-blue.png')}}" alt="notefy"><br>

        <div class="d-inline-flex align-items-center">
            <img class="me-4" width="100" src="{{asset('img/check-mark.png')}}" alt="checked">
            <h5 style="color:#0b61bf;">Usuário foi registrado com sucesso. Te enviamos um link, verifique seu email para habilitar funcionalidades da conta.</h5>
        </div>

        <a style="background:#0b61bf;" class="my-5 btn border-o btn-primary" href="{{route('auth.login')}}">Entrar no Notefy</a>

    </div>

@endsection