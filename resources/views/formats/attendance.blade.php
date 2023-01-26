@extends('app')


@section('plugins.icheck', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Reclutamiento</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('recruitment.candidates') }}">Candidatos</a></li>
            </ol>
        </nav>
    @stop
    
    <div class="row">

        
        <div class="card col-12 card-tabs">
            <div class="card-header">
                <h3 class="card-title">Formato de Asistencias</h3>
                <div class="card-tools">
                    <!-- Maximize Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>            
            </div>
            
            <div class="card-body p-0">                
            
                <form action="{{ route('format.attendance.download') }}" method="POST" target="_blank">
                    @csrf                   
                    <div class="row">

                        <div class="form-group col-12 col-lg-4">
                            <label for="">Empresa</label>
                            <select name="company_id" id="company_id" class="form-control">
                                @if (count($companies))
                                    @foreach ($companies as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="">Titulo</label>
                            <input type="text" class="form-control" name="title" placeholder="Ejemplo: Control de Asistencia Quincena 01" value="Control de Asistencia Quincena " required>
                        </div>

                        <div class="col-sm-12 col-lg-2">
                            <label for="">Fecha de inicio</label>
                            <div class="input-group date" id="start_date" data-target-input="nearest">                            
                                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div> 
                                <input type="text" class="form-control datetimepicker-input" data-target="#start_date" data-toggle="datetimepicker" name="start_date" value="" autocomplete="off" required/>
                            </div>
                        </div>

                    </div>
                    

                    <div class="col-sm-12 p-2 d-flex justify-content-between">      
                        <button class="btn btn-primary">
                            Generar
                        </button>
                    </div>
        
                </form>

                
            </div>    
        </div>


        <div class="col-12">
            @if ($errors->any())
                <div class="col-12 alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            @if(session('success'))
                <div class="col-12 alert alert-success" role="alert">
                    <h1>{{session('success')}}</h1>
                </div>
                
            @endif
        </div>

    </div>
@stop


@section('js')
    <script>
        $(function () {
            $('#start_date').datetimepicker({
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                format: 'YYYY-MM-DD'
            });

            $('#end_date').datetimepicker({
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                format: 'YYYY-MM-DD'
            });
        });   
    </script>
@endsection
