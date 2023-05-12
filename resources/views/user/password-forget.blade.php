@extends('layout.nav-layout')

@section('tittle','Notefy - Esqueci a senha')

{{--content--}}
@section('content')
    
    <div class="d-flex align-items-center justify-content-center w-100">

            <div class="row h-100 w-100">

                <div style="background-image: url({{asset('img/just-waves.png')}})" class="col h-100 w-100 d-flex justify-content-center align-items-center">
                    <div class="">
                        <img style="width:500px" src="{{asset('img/notefy-logo-blue.png')}}" class="" alt="Notefy">
                    </div>
                </div>

                <div class="col d-flex align-items-center">

                    @if ($errors->all())
                        @component('component.alert-danger')
                            @slot('error')
                                {{$errors->first()}}
                            @endslot
                        @endcomponent
                    @endif
                    
                    <form method="post" action="{{route('user.auth')}}">
                        <h6>Digite aqui seu e-email. Enviaremos um código para o acesso a sua nova senha.</h6>
                        @csrf
                        <div style="width: 68vh" class="mb-3">
                            <label for="inputemail" class="col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="inputemail">
                            </div>
                        </div>
                        
                        <button style="width: 80px" class="btn btn-primary" type="submit">Enviar</button>
                        </div>
        
                    </form>
                
                </div>
            

            
        </div>

    </div>

@endsection