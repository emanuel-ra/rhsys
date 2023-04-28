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

        <div class="card card-tabs">

            <div class="card-header">
                <h3 class="card-title">Graficas de Barras</h3>
                <div class="card-tools">
                    <!-- Maximize Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>            
            </div>

            <div class="card-body  p-0">
                @foreach ($data as $item)
                    <div class="row">
                        @include('reports.census.charts.bar.census',['uuid'=>$item["uuid"],'branch_name'=>$item["branch_name"]])
                    </div>    
                @endforeach                
            </div>

        </div>


    @stop

    @section('js')        
        
        {{-- BAR CHARTS  --}}
        <script>
            let bg_colors = [
                'rgb(0, 200, 83)' ,
                'rgb(0, 145, 234)' ,
                'rgb(221, 44, 0)' ,               
                'rgb(0, 77, 64)' ,
                'rgb(213, 0, 0)' ,
                'rgb(174, 234, 0)' ,
                'rgb(41, 98, 255)' ,                
            ]

            const data =  {!! json_encode($data) !!}

            data.map( (value,index) => {

                let contexto = document.getElementById(`census_${value.uuid}`).getContext('2d');

                let dataAuthorized = value.authorized;               
                
                let drawChart = new Chart(contexto,{
                    type: 'horizontalBar',                    
                    data: { 
                        labels: dataAuthorized.map( labels => { return labels.label }) ,
                        datasets:[
                            {
                                label: `Vacantes Autorizadas` ,
                                data: dataAuthorized.map( ds => { return ds.authorized } ) ,
                                backgroundColor: "rgba(3, 169, 244,0.5)" , 
                                borderColor: "rgb(3, 169, 244)" , 
                                borderWidth: 1
                            },
                            {
                                label: `Personal Actual` ,
                                data: dataAuthorized.map( ds => { return ds.staff_quantity } ) ,
                                backgroundColor: "rgba(56, 142, 60,0.5)" , 
                                borderColor: "rgb(56, 142, 60)" , 
                                borderWidth: 1
                            },
                            {
                                label: `Vacantes por contratar` ,
                                data: dataAuthorized.map( ds => { return Math.abs(ds.authorized-ds.staff_quantity) } ) ,
                                backgroundColor: "rgba(211, 47, 47,0.5)" , 
                                borderColor: "rgb(211, 47, 47)" , 
                                borderWidth: 1
                            }
                        ]
                    } ,
                    options: {
                        responsive:true ,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true ,
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                })
           
                console.log(drawChart.data)
            });
        </script>

    @endsection

@stop
