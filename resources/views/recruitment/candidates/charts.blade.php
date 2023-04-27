@extends('app')

@section('plugins.imask', true)
@section('plugins.FileInput', true)

@section('plugins.Chartjs', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Reclutamiento</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('recruitment.candidates') }}">Candidatos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitment.candidates.charts') }}">Graficas</a></li>
            </ol>
        </nav>

        <div class="row">
            <div class="card col-12">
                <div class="card-header">
                    <h3 class="card-title">Filtros</h3>    
                </div>
                <div class="card-body">
                    <form action="{{route('recruitment.candidates.charts') }}" class="row" method="POST">
                        @csrf
                        <div class="col-sm-12 col-md-2">
                            <x-dg-input-date id="start_date" name="start_date" label="Fecha de Inicio" value="{{ \Carbon\Carbon::parse($start_date)->format('Y-m-d') }}" />
                        </div>
                        
                        <div class="col-sm-12 col-md-2">
                            <x-dg-input-date id="ended_date" name="ended_date" label="Fecha de Fin" value="{{ \Carbon\Carbon::parse($ended_date)->format('Y-m-d') }}" />
                        </div>

                        <div class="col-12">
                            <button class="btn btn-info float-right">
                                <i class="fa fa-search"></i> Filtrar Resultados
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-tabs">

            <div class="card-header">
                <h3 class="card-title">Graficas de PAI</h3>
                <div class="card-tools">
                    <!-- Maximize Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>            
            </div>

            <div class="card-body  p-0">
                <div class="row">
                    @include('recruitment.candidates.charts.pie.accepted')
                    @include('recruitment.candidates.charts.pie.hired')
                    @include('recruitment.candidates.charts.pie.sources')
                </div>
            </div>

        </div>

        <div class="card card-tabs">

            <div class="card-header">
                <h3 class="card-title">Graficas de Barras</h3>
                <div class="card-tools">
                    <!-- Maximize Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>            
            </div>

            <div class="card-body  p-0">
                <div class="row">
                    @include('recruitment.candidates.charts.bar.byuser')                   
                </div>
            </div>

        </div>

    @stop

    @section('js')
        
        {{-- { PIE CHARTS } --}}
        <script>
            let colors_status = ['rgb(249, 168, 37)','rgb(21, 101, 192)','rgb(198, 40, 40)']
            const accepted_labels = ['Pendiente','Aceptado','Rechazado']
            const hired_labels = ['Pendiente','Contratado','No Contratado']

            // ACCEPTED CANDIDATES 
            const ctx_pie_char_candidates_accepted = document.getElementById("pie_char_candidates_accepted").getContext('2d');
            let pie_candidates_accepted =  {!! json_encode($pie_candidates_accepted) !!}            
            const draw_pie_candidates_accepted = new Chart(ctx_pie_char_candidates_accepted, {
                type: 'doughnut',
                data: {
                    labels: pie_candidates_accepted.map((i)=>{ return `${accepted_labels[i.is_accepted]}` }),
                    datasets: [{
                        //label: 'Bajas ',
                        data: pie_candidates_accepted.map((i)=>{ return i.data }) ,
                        backgroundColor: pie_candidates_accepted.map((i)=>{ return `${colors_status[i.is_accepted]}` }),
                        borderColor: pie_candidates_accepted.map((i)=>{ return `${colors_status[i.is_accepted]}` }),
                        borderWidth: 1
                    }]
                },
                options: {
                    //cutoutPercentage: 40,
                    responsive: true,
                    legend: {
                        position: 'right'
                    }

                }
            });

            // HIRED CANDIDATES 
            const ctx_pie_char_candidates_hired = document.getElementById("pie_char_candidates_hired").getContext('2d');
            let pie_candidates_hired =  {!! json_encode($pie_candidates_hired) !!}            
            const draw_pie_candidates_hired = new Chart(ctx_pie_char_candidates_hired, {
                type: 'doughnut',
                data: {
                    labels: pie_candidates_hired.map((i)=>{ return `${hired_labels[i.is_hired]}` }),
                    datasets: [{
                        //label: 'Bajas ',
                        data: pie_candidates_hired.map((i)=>{ return i.data }) ,
                        backgroundColor: pie_candidates_hired.map((i)=>{ return `${colors_status[i.is_hired]}` }),
                        borderColor: pie_candidates_hired.map((i)=>{ return `${colors_status[i.is_hired]}` }),
                        borderWidth: 1
                    }]
                },
                options: {
                    //cutoutPercentage: 40,
                    responsive: true,
                    legend: { position: 'right' }
                }
            });
            
            // SOURCE CANDIDATES 
            const ctx_pie_candidates_sources = document.getElementById("pie_candidates_sources").getContext('2d');
            let pie_candidates_sources =  {!! json_encode($pie_candidates_sources) !!}            
            const draw_pie_candidates_sources = new Chart(ctx_pie_candidates_sources, {
                type: 'doughnut',
                data: {
                    labels: pie_candidates_sources.map((i)=>{ return `${i.label}` }),
                    datasets: [{
                        //label: 'Bajas ',
                        data: pie_candidates_sources.map((i)=>{ return i.data }) ,
                        backgroundColor: pie_candidates_sources.map((val,index)=>{ return (index%2==0) ? 'rgb(13, 71, 161)':'rgb(46, 125, 50)'}),
                        borderColor: pie_candidates_sources.map((val,index)=>{ return (index%2==0) ? 'rgb(13, 71, 161)':'rgb(46, 125, 50)'}),
                        borderWidth: 1
                    }]
                },
                options: {
                    //cutoutPercentage: 40,
                    responsive: true,
                    legend: { position: 'right' }
                }
            });
            
        </script>
        {{-- BAR CHARTS  --}}
        <script>
            var ctx_bar_candidates_by_users = document.getElementById("bar_candidates_by_users").getContext('2d');
            let bar_candidates_users =  {!! json_encode($bar_candidates_users) !!}      

            var draw_bar_candidates_users = new Chart(ctx_bar_candidates_by_users, {
                type: 'bar',
                data: { labels: ["Registros por Usuarios"] },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true ,
                                stepSize: 1
                            }
                        }]
                    }
                }
            });
            
            bar_candidates_users.map((val,ind) => {
                draw_bar_candidates_users.data.datasets.push({
                    label: `${val.label}` ,
                    data: [val.data] ,
                    backgroundColor:(ind%2==0) ? 'rgb(13, 71, 161)':'rgb(46, 125, 50)' ,
                    borderColor: (ind%2==0) ? 'rgb(13, 71, 161)':'rgb(46, 125, 50)',
                    borderWidth: 1
                });
                draw_bar_candidates_users.update();
            })            

        </script>

    @endsection

@stop
