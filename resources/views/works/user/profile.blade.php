@extends('layout.nav-layout')

@section('tittle', 'Notefy - Seu perfil')

@push('css')
    <style>
        
        .image-radio input[type="radio"] {
            display: none;
        }

        .image-radio input[type="radio"]:checked + img{
            border: 2px solid blue;
        }

    </style>
@endpush

@push('js')
    
@endpush

@section('content')
    
<div class="container d-grid align-content-center">

    <div class="row">

        <div class="col-md-4 offset-md-4">

            <div class="text-center">
                {{--button to the modal--}}
                <button class="btn" data-bs-toggle="modal" data-bs-target="#changeicon">
                    <img width="200" src="{{asset('img/icons/icon2.png')}}" alt="Profile Picture" class="profile-picture">
                </button>

                <h4 class="my-4">{{ Auth::user()->name }}</h4>
            </div>

            {{--modal--}}
            <div class="modal fade" id="changeicon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">

                  <div class="modal-content">

                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Mude o seu ícone</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      
                        <form action="{{route('user.edit')}}" method="post">
                    
                            <label class="image-radio">
                                <img width="100" src="{{asset('img/icons/icon1.png')}}" alt="icon1">
                                <input class="hidden" type="radio" name="group" value="icon1.png" />
                            </label>

                            <label class="image-radio">
                                <img width="100" src="{{asset('img/icons/icon2.png')}}" alt="icon2">
                                <input class="hidden" type="radio" name="group" value="icon2.png" />
                            </label>

                            <label class="image-radio">
                                <img width="100" src="{{asset('img/icons/icon3.png')}}" alt="icon3">
                                <input class="hidden" type="radio" name="group" value="icon3.png" />
                            </label>

                            <br>

                            <label class="image-radio">
                                <img width="100" src="{{asset('img/icons/icon4.png')}}" alt="icon4">
                                <input class="hidden" type="radio" name="group" value="icon4.png" />
                            </label>

                            <label class="image-radio">
                                <img width="100" src="{{asset('img/icons/icon5.png')}}" alt="icon5">
                                <input class="hidden" type="radio" name="group" value="icon5.png" />
                            </label>

                            <label class="image-radio">
                                <img width="100" src="{{asset('img/icons/icon6.png')}}" alt="icon6">
                                <input class="hidden" type="radio" name="group" value="icon6.png" />
                            </label>
                        
                        </form>

                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button style="background: #0b61be" type="button" class="btn btn-primary border-0">Confirmar</button>
                    </div>

                  </div>

                </div>
            </div>

            <hr>

            <form method='post' action="{{route('user.edit')}}">
                @csrf
                <div class="form-group my-3">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" disabled>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" disabled>
                </div>

                <div class="form-group my-3">
                    <a style="background: #0b61be" href="#" class="btn btn-primary border-0">Alterar dados</a>
                </div>

                <div class="form-group mt-5">
                    <a href="#" class="btn btn-danger">Mude sua senha</a>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection