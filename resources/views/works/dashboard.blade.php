@extends('layout.nav-layout')

@section('tittle', 'Notefy - Painel')

@push('font')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
@endpush

@push('library')
    {{--chart.js - the grafics library--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.min.js" integrity="sha512-TJ7U6JRJx5IpyvvO9atNnBzwJIoZDaQnQhb0Wmw32Rj5BQHAmJG16WzaJbDns2Wk5VG6gMt4MytZApZG47rCdg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/helpers.min.js" integrity="sha512-JG3S/EICkp8Lx9YhtIpzAVJ55WGnxT3T6bfiXYbjPRUoN9yu+ZM+wVLDsI/L2BWRiKjw/67d+/APw/CDn+Lm0Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('js')
    <script>

        //comparação das qnt de palavras das notas
        const compare_notes = document.getElementById('note_chart');
        new Chart(compare_notes, {
            type: 'bar',

          
            data: {
                labels: [
                    'Titulo 1', 'Titulo 2', 'Titulo 3', 'Titulo 4'
                ],
                datasets: [{
                label: 'Quantidade de palavras',
                data: [12, 100, 92, 5],
                borderWidth: 0, 
                backgroundColor: '#0b61bf',
                borderRadius: '16',
                }]
            },

            options: {
                scales: {
                y: {
                    beginAtZero: true,
                    max: 100*1.5
                }
                }
            }

        });

        //comparação das tarefas feitas e não feitas
        const compare_tasks = document.getElementById('task_chart');
        new Chart(compare_tasks, {
              type: 'doughnut',

            data: {
                labels: ['Não realizadas','Realizadas'],

                datasets: [{
                    label: 'Tarefas completas x Tarefas imcompletas',
                    data: [300, 50],
                    backgroundColor: [
                        '#e70909',
                        '#5ecd49',
                    ],
    
                    hoverOffset: 10
                }]

            }
        })


    </script>
@endpush

@push('warning')
    <div class="h-25 bg-warning text-white bold">
        <p class="m-3">
            @if (session('email'))
                {{session('email')}}
            @endif
        </p>
    </div>
@endpush

@section('content')

    <div style="font-family: Poppins" class="container-fluid">
        
        <div class="d-flex flex-column m-3">

            <h5 class="mb-5">Anotações</h5>

            <div class="d-flex mb-5">

                <div class="w-auto container-fluid shadow-lg p-3 bg-body-tertiary rounded">
                    <h5>Quantidade de notas</h5><br>
                    <h3>12</h3>
                </div>
    
                <div class="w-auto container-fluid shadow-lg p-3 bg-body-tertiary rounded">
                    <h5>Quantidade de palavras nas notas</h5><br>
                    <h3>1221</h3>
                </div>

                <div class="w-auto container-fluid shadow-lg p-3 bg-body-tertiary rounded">
                    <h5>Ultima modificação</h5><br>
                    <h3>15/05/2023 - 12:45</h3>
                </div>

                <div class="w-auto container-fluid shadow-lg p-3 bg-body-tertiary rounded">
                    <h5>Recentes</h5><br>
                    <h3>Nome 1 , nome 2 [...]</h3>
                </div>

            </div>

            <div class="m-3">
                <h5>Comparação de mais utilidade em cada notas</h5>
                <div class="w-50">
                    <canvas id="note_chart"></canvas>
                </div>
            </div>

            <a class="mx-4" href=""><h4>Vejas suas notas..</h4></a>

            <h5 class="my-5">Tarefas</h5>

            <div class="d-flex mb-5">

                <div class="w-auto container-fluid shadow-lg p-3 bg-body-tertiary rounded">
    
                    <h5>Quantidade de listas de tarefas</h5><br>
                    <h3>12</h3>
    
                </div>
                
                <div class="w-auto container-fluid shadow-lg p-3 bg-body-tertiary rounded">
        
                    <h5>Quantidade de tarefas</h5><br>
                    <h3>12</h3>
    
                </div>

                <div class="w-auto container-fluid shadow-lg p-3 bg-body-tertiary rounded">
        
                    <h5>Listas de tarefa com lembrete de email ativo</h5><br>
                    <h3>Tarefa 1, Tarefa 2, Tarefa 3 [...]</h3>
    
                </div>

                <div class="w-auto container-fluid shadow-lg p-3 bg-body-tertiary rounded">
        
                    <h5>Listas de tarefas finalizadas</h5><br>
                    <h3>2</h3>
    
                </div>

            </div>

                <div class="w-25 mb-5">
                    <canvas id="task_chart"></canvas>
                </div>

            <a class="mx-4" href=""><h4>Veja suas tarefas..</h4></a>

        </div>
    </div>


@endsection