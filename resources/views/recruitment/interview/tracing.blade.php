@extends('app')
{{-- 
@section('plugins.imask', true) --}}

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Reclutamiento</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('recruitment.interview.appointment') }}">Entevistas</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitment.interview.form.create',['id'=>$data->id]) }}">Nuevo</a></li>
            </ol>
        </nav>
    @stop

    <div class="card card-tabs">
        <div class="card-header">
            <h3 class="card-title">Seguimiento Entrevista</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>            
        </div>

        <div class="card-body  p-0">

            <form action="{{ route('recruitment.interview.tracing') }}" method="POST">
                @csrf
                
                <input type="hidden" name="id" value="{{ $data->id }}">
                

                <div class="row p-2">
                    
                    <div class="col-sm-12 col-lg-4">
                        <x-dg-input type="text" label="Nombre" name="name" maxlength="255" value="{{$data->candidate->name}}" disabled placeholder=""  />
                    </div>

                    <div class="col-sm-12 col-lg-4">
                        <x-dg-input type="text" label="Email" name="email" maxlength="255" value="{{$data->candidate->email}}" disabled placeholder=""  />
                    </div>

                    <div class="col-sm-12 col-lg-4">
                        <x-dg-input type="text" label="Teléfono" name="mobile_phone" maxlength="255" value="{{$data->candidate->mobile_phone}}" disabled placeholder=""  />
                    </div>
                    
                    <div class="col-sm-12 col-lg-4">
                        <x-dg-input type="text" label="Sucursal" name="branch_name" maxlength="255" value="{{$data->candidate->requisitions->branch->name}}" disabled placeholder=""  />
                    </div>

                    <div class="col-sm-12 col-lg-4">
                        <x-dg-input type="text" label="Vacante" name="position_name" maxlength="255" value="{{$data->candidate->requisitions->position->name}}" disabled placeholder=""  />
                    </div>

                    <div class="col-sm-12 col-lg-4">
                        <x-dg-input type="text" label="Tipo de Entrevista" name="type_interview" maxlength="255" value="{{$data->type_interview->name}}" disabled placeholder=""  />
                    </div>

                    <div class="col-sm-12 col-lg-4">
                        <label for="">Fecha y hora de la entrevista</label>
                        <div class="input-group date"  >                            
                            <div class="input-group-append" >
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div> 
                            <input type="text" class="form-control datetimepicker-input" value="{{ $data->interview_date }}" readonly/>
                        </div>
                    </div>

                                        
                    <div class="col-12 col-sm-1">
                        <label>Asiste?</label>
                        <div class="icheck-primary">
                            <input type="radio" id="attendance_yes" name="attendance" class="icheck-primary" value="1" />
                            <label for="attendance_yes">Si</label>
                        </div>
                        <div class="icheck-danger">
                            <input type="radio" id="attendance_no" name="attendance" class="icheck-danger" value="2" />
                            <label for="attendance_no">No</label>
                        </div>
                    </div>
                
                    <div class="col-12 col-lg-1">
                        <label for="">Reprogramar</label>
                        <div class="icheck-primary">
                            <input type="checkbox" id="reschedule" name="reschedule" />
                            <label for="reschedule">Si</label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-2">                        
                        <label for="">Nueva fecha</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">                            
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div> 
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" data-toggle="datetimepicker" name="interview_new_date"/>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">                        
                        <blockquote>
                            <b>Comentarios</b> <br>
                            {{ $data->commentaries }}
                        </blockquote>
                    </div>

                    <div class="col-sm-12">
                        <label for="">Observeaciones</label>
                        <textarea name="observations" class="form-control" maxlength="500"></textarea>
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
                    
                <div class="col-sm-12 p-2 d-flex justify-content-between">
                    
                    <a href="{{ route('recruitment.requisitions') }}" class="btn btn-default">
                        Cancelar
                    </a>

                    <button class="btn btn-primary">
                        Guardar
                    </button>
                </div>
    
            </form>

            
        </div>
    
    </div>

@stop


@section('js')
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                } 
            });
        });
    </script>
@endsection
