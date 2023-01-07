@extends('app')


@section('plugins.icheck', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Reclutamiento</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('recruitment.candidates') }}">Candidatos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitment.candidates.form.tracing',['id'=>$Candidate->id]) }}">Seguimiento</a></li>
            </ol>
        </nav>
    @stop
    
    <div class="row">

        <div class="col-12">
            <blockquote>
                <b>Nombre</b>: {{ $Candidate->name }} <br>
                <b>Teléfono</b>: {{ $Candidate->mobile_phone }} <br>
                <b>Email</b>: {{ $Candidate->email }} <br>
                <b>Origen</b>: {{ $Candidate->candidatesource->name }} <br>
                <b>Requisición</b>: {{ $Candidate->requisitions->branch->name }} <br>
                <b>Puesto</b>: {{ $Candidate->requisitions->position->name }} <br>
            </blockquote>
        </div>

        <div class="card col-12 col-lg-3 m-2 card-tabs">
            <div class="card-header">
                <h3 class="card-title">Encargado de Area</h3>
                <div class="card-tools">
                    <!-- Maximize Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>            
            </div>

            <div class="card-body p-0">

            
                <form action="{{ route('recruitment.candidates.update.accepted') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $Candidate->id }}">
                    <div class="row p-2">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="radio" id="is_accepted1" name="is_accepted" value="1" required {{ ($Candidate->is_accepted==1) ? 'checked':'' }} />
                                <label for="is_accepted1">Acepto</label>
                            </div>
                            <div class="icheck-primary">
                                <input type="radio" id="is_accepted2" name="is_accepted" value="2" required {{ ($Candidate->is_accepted==2) ? 'checked':'' }} />
                                <label for="is_accepted2">Rechazo</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 p-2 d-flex justify-content-between">
                        
                        <a href="{{ route('recruitment.candidates') }}" class="btn btn-default">
                            Cancelar
                        </a>

                        <button class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
        
                </form>

                
            </div>    
        </div>

        <div class="card col-12 col-lg-3 m-2 card-tabs">
            <div class="card-header">
                <h3 class="card-title">Contratado</h3>
                <div class="card-tools">
                    <!-- Maximize Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>            
            </div>

            <div class="card-body p-0">

            
                <form action="{{ route('recruitment.candidates.update.hired') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $Candidate->id }}">
                    <div class="row p-2">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="radio" id="is_hired" name="is_hired" value="1" required {{ ($Candidate->is_hired==1) ? 'checked':'' }} />
                                <label for="is_hired">Si</label>
                            </div>
                            <div class="icheck-primary">
                                <input type="radio" id="is_hired2" name="is_hired" value="2" required {{ ($Candidate->is_hired==2) ? 'checked':'' }} />
                                <label for="is_hired2">No</label>
                            </div>

                            <div class="col-sm-12 ">
                                <label for="">Fecha de contratación</label>
                                <div class="input-group date" id="dateHired" data-target-input="nearest">                            
                                    <div class="input-group-append" data-target="#dateHired" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div> 
                                    <input type="text" class="form-control datetimepicker-input" data-target="#dateHired" data-toggle="datetimepicker" name="date_hired" value="{{ $Candidate->hired_date }}"/>
                                </div>
                            </div>

                        </div>
                    </div>
                        
                    <div class="col-sm-12 p-2 d-flex justify-content-between">
                        
                        <a href="{{ route('recruitment.candidates') }}" class="btn btn-default">
                            Cancelar
                        </a>

                        <button class="btn btn-primary">
                            Guardar
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
        </div>

    </div>
@stop


@section('js')
    <script>
        $(function () {
            $('#dateHired').datetimepicker({
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
