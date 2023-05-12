@extends('layout.nav-layout')

@section('tittle','Notefy - Entrar')

{{--content--}}
@section('content')
    
    <div class="d-flex flex-column align-items-center w-100 h-100 align-self-center">

        <div style="background: #0b61bf" class="w-75 rounded">
            <div class="row py-5 justify-content-center">
                <img style="width:500px" src="{{asset('img/notefy-logo-white.png')}}" class="" alt="Notefy">
            </div>
            

            {{--formulario--}}
            <div class="container-fluid shadow-lg p-3 mb-5 bg-body-tertiary rounded w-50 ">

              @if ($errors->all())
                  @component('component.alert-danger')
                      @slot('error')
                          {{$errors->first()}}
                      @endslot
                  @endcomponent
              @endif

            <form method="post" action="{{route('user.auth')}}">
             @csrf 
              <div class="mb-3 row">
                <label for="inputemail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="inputemail">
                </div>
              </div>
              
              <div class="mb-3 row">
                <label for="inputpassword" class="col-sm-2 col-form-label">Senha</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="inputpassword">
                </div>
              </div>
              <div class="d-flex flex-column align-self-start">
                <button style="width: 80px" class="btn btn-primary" type="submit">Entrar</button>
                <label for="relemberme" class="mt-2">
                  <input type="checkbox" class="form-check-input" name="relemberme" id="relemberme">
                  Lembre de mim
                </label>
                <a class="link-underline link-underline-opacity-0 mt-3" href="{{route('user.forget')}}">Esqueceu sua senha?</a>
              </div>

            </form>
        </div>
        
        </div>

    </div>

@endsection