<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
    <title>@yield('tittle')</title>
    @include('include.bootstrap5.css')
</head>

<body>
    
    <main>@yield('content')</main>

    @include('include.bootstrap5.js')
</body>

</html>