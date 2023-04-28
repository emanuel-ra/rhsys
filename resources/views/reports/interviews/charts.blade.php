@extends('app')

@section('plugins.imask', true)
@section('plugins.FileInput', true)

@section('plugins.Chartjs', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Reporte</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('reports.interviews') }}">Entrevistas</a></li>
                <li class="breadcrumb-item"><a href="{{ route('reports.interviews.charts') }}">Graficas</a></li>
            </ol>
        </nav>

        <div class="row">
            <div class="card col-12">
                <div class="card-header">
                    <h3 class="card-title">Filtros</h3>    
                </div>
                <div class="card-body">
                    <form action="{{route('reports.interviews.charts') }}" class="row" method="POST">
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
                    @include('reports.interviews.charts.pie.byuserscomplete')
                    @include('reports.interviews.charts.pie.bytypescomplete')
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
                    @include('reports.interviews.charts.bar.bybranchstatus')
                    @include('reports.interviews.charts.bar.bybranchattendance')
                </div>
            </div>

        </div>

        <div class="card card-tabs">

            <div class="card-header">
                <h3 class="card-title">Graficas de Lineas</h3>
                <div class="card-tools">
                    <!-- Maximize Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>            
            </div>

            <div class="card-body  p-0">
                <div class="row">
                    @include('reports.interviews.charts.lines.bycompletedates')                    
                </div>
            </div>

        </div>

    @stop

    @section('js')
        
        {{-- PIE CHARTS  --}}
        <script>
            // BY STATUS
            let bg_colors = [
                'rgb(0, 200, 83)' ,
                'rgb(0, 145, 234)' ,
                'rgb(221, 44, 0)' ,               
                'rgb(0, 77, 64)' ,
                'rgb(213, 0, 0)' ,
                'rgb(174, 234, 0)' ,
                'rgb(41, 98, 255)' ,                
            ]

            // COMPLETE BY USERS 
            const ctx_pie_char_users_complete = document.getElementById("pie_char_users_complete").getContext('2d');
            let data_interviews_by_users_complete =  {!! json_encode($interviews_by_users_complete) !!}          

            const draw_pie_char_users_complete = new Chart(ctx_pie_char_users_complete, {
                type: 'doughnut',
                data: {
                    labels: data_interviews_by_users_complete.map((i)=>{ return `${i.label}` }),
                    datasets: [{
                        //label: 'Bajas ',
                        data: data_interviews_by_users_complete.map((i,index)=>{ return i.data }) ,
                        backgroundColor: data_interviews_by_users_complete.map((i,index)=>{ return `${bg_colors[index]}` }),
                        borderColor: data_interviews_by_users_complete.map((i,index)=>{ return `${bg_colors[index]}` }),
                        borderWidth: 1
                    }]
                },
                options: {
                    //cutoutPercentage: 40,
                    responsive: true,
                    legend: { position: 'right' }
                }
            });

            // COMPLETE BY TYPE 
            const ctx_pie_char_type_complete= document.getElementById("pie_char_type_complete").getContext('2d');
            let data_interviews_by_types_complete=  {!! json_encode($interviews_by_types_complete) !!}          

            const draw_pie_char_type_complete = new Chart(ctx_pie_char_type_complete, {
                type: 'doughnut',
                data: {
                    labels: data_interviews_by_types_complete.map((i)=>{ return `${i.label}` }),
                    datasets: [{
                        //label: 'Bajas ',
                        data: data_interviews_by_types_complete.map((i,index)=>{ return i.data }) ,
                        backgroundColor: data_interviews_by_types_complete.map((i,index)=>{ return `${bg_colors[index]}` }),
                        borderColor: data_interviews_by_types_complete.map((i,index)=>{ return `${bg_colors[index]}` }),
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

            var ctx_bar_interviews_by_branch_status = document.getElementById("bar_interviews_by_branch_status").getContext('2d');
            let data_interviews_by_branch_status =  {!! json_encode($interviews_by_branch_status) !!}

            var draw_bar_interviews_by_branch_status = new Chart(ctx_bar_interviews_by_branch_status, {
                type: 'bar',
                data: { labels: ["PENDIENTES","REALIZADAS"] } , 
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

            data_interviews_by_branch_status.map((val,ind) => {
                draw_bar_interviews_by_branch_status.data.datasets.push({
                    label: `${val.label}` ,
                    data: val.data.map((i)=>{ return i }) ,
                    backgroundColor:bg_colors[ind] ,
                    borderColor: bg_colors[ind],
                    borderWidth: 1
                });
                draw_bar_interviews_by_branch_status.update();
            })         

            // BY ATENDANCE
            var ctx_bar_interviews_by_branch_attendance = document.getElementById("bar_interviews_by_branch_attendance").getContext('2d');
            let data_interviews_by_branch_attendance =  {!! json_encode($interviews_by_branch_attendance) !!}      

            var draw_bar_interviews_by_branch_attendance = new Chart(ctx_bar_interviews_by_branch_attendance, {
                type: 'bar',
                data: { labels: ["ASISTENCIAS","SIN ASITENCIAS"] } , 
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

            data_interviews_by_branch_attendance.map((val,ind) => {
                draw_bar_interviews_by_branch_attendance.data.datasets.push({
                    label: `${val.label}` ,
                    data: val.data.map((i)=>{ return i }) ,
                    backgroundColor:bg_colors[ind] ,
                    borderColor: bg_colors[ind],
                    borderWidth: 1
                });
                draw_bar_interviews_by_branch_attendance.update();
            })
        </script>

        {{-- LINE CHARTS --}}
        <script>

            const ctx_line_char_complete_by_dates = document.getElementById("line_char_complete_by_dates").getContext('2d');
            let data_interviews_by_year=  {!! json_encode($interviews_by_year) !!}          
            
            const months = [...data_interviews_by_year[0].data];

            const draw_line_char_complete_by_dates = new Chart(ctx_line_char_complete_by_dates, {
                type: 'line',
                data: {
                    labels: months.map( v => { return `${v.month} ${v.year}`; }) ,                    
                } , 
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Chart.js Line Chart'
                        }
                    }
                }
            });


            data_interviews_by_year.map( (v,i) => {
                draw_line_char_complete_by_dates.data.datasets.push({
                    label: v.label,
                    data: v.data.map( d => { return d.data }) ,
                    borderColor: bg_colors[i] ,
                    backgroundColor: 'rgba(183, 28, 28,0)',
                });
            });
            
            draw_line_char_complete_by_dates.update();

            console.log(draw_line_char_complete_by_dates.data)
        </script>

    @endsection

@stop
