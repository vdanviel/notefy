<html class="h-100" lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body class="h-100">
    
    <main class="d-flex justify-content-center align-items-center h-100">

        <div class="d-flex flex-column align-items-center" style="font-family: Arial, Helvetica, sans-serif; color:#0b61bf;" class="text-center">
            <img class="mb-5" width="300" src="{{$message->embed($logo)}}" alt="notefy"><br>

            <div class="d-inline-flex align-items-center">
                <h1 class="mb-5" style="color:#0b61bf;">Olá! Para verificar o seu e-mail, clique no link abaixo:</h1>
                <p>Este link vai te redirecionar para um algoritmo que valida sua identidade e desbloqueia fucionalidades da aplicação.</p>
                <a style="color: #0035ff" href="{{$link}}">{{$link}}</a>
            </div>
        </div> 

    </main>
    

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>