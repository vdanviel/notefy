@extends('layout.clean-layout')

@section('tittle','Notefy - Nova senha')

{{--content--}}
@section('content')

    <div class="d-flex flex-column align-items-center align-self-center">

            <div class="row py-5 justify-content-center">
                <img style="width:500px" src="{{asset('img/notefy-logo-blue.png')}}" class="" alt="Notefy">
            </div>

            {{--formulario--}}
            <div class="container-fluid shadow-lg p-3 rounded ">

              @if ($errors->all())
                  @component('component.alert-danger')
                      @slot('error')
                          {{$errors->first()}}
                      @endslot
                  @endcomponent
              @endif

            <form method="post" action="{{route('password.update')}}">
             @csrf 
             <h6>Digite sua nova senha.</h6>

             <input type="hidden" name="token" value="{{$token}}">            

              <div class="mb-3 row">
                <label for="inputemail" class="col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" value="{{request()->email}}" name="email" class="form-control" id="inputemail">
                </div>
              </div>
              
              <div class="mb-3 row">
                <label for="inputpassword" class="col-form-label">Nova senha</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="inputpassword">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="inputpasswordconfirmation" class="col-form-label">Confirme a nova senha</label>
                <div class="col-sm-10">
                  <input type="password" name="password_confirmation" class="form-control" id="inputpasswordconfirmation">
                </div>
              </div>
              
                <button class="btn btn-primary" type="submit">Enviar</button>
              </div>

            </form>
        
        </div>

    </div>

@endsection