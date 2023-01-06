@extends('app')

@section('plugins.imask', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Reclutamiento</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('recruitment.interview.appointment') }}">Entevistas</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitment.interview.form.create',['id'=>$data->id]) }}">Vista</a></li>
            </ol>
        </nav>
    @stop

    <div class="card card-tabs">
        <div class="card-header">
            <h3 class="card-title">Información Entrevista</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>            
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-12 col-lg-3">
                    <h3>Cantidato:</h3>
                    <b>Nombre: </b> {{ $data->candidate->name }} <br>
                    <b>Email: </b> {{ $data->candidate->email }} <br>
                    <b>Teléfono: </b> {{ $data->candidate->mobile_phone }} <br>
                    <b>Origen: </b> {{ $data->candidate->candidatesource->name }} <br>
                </div>

                <div class="col-12 col-lg-3">
                    <h3>Requisicion:</h3>
                    <b>Sucursal: </b> {{ $data->candidate->requisitions->branch->name }} <br>
                    <b>Posicion: </b> {{ $data->candidate->requisitions->position->name }} <br>
                    <b>Tipo de Entrevista: </b> {{ $data->type_interview->name }} <br>
                    <b>Estatus: </b> {{ $data->status->name }} <br>
                </div>

             
                <div class="col-12 col-lg-3">
                    <h3></h3>
                    <b>Asistencia: </b> <span class="{{ ($data->attendance) ? 'text-info':'text-danger'}}">{{ ($data->attendance) ? 'Si Asistio':'No Asistio' }}</span> <br>

                    <b>Reagendado: </b> {{ ($data->reschedule) ? 'Si':'No' }} <br>
                    @if ($data->reschedule)
                        <b>Fecha Reagendada:</b> <a href="{{ route('recruitment.interview.open',['id'=>$data->reschedule_id]) }}">{{ $data->reschedule_date  }}</a> <br>   
                    @endif

                </div>

            </div>

            <blockquote>
                <b>Comentarios: </b> <br>
                {{ $data->commentaries }}
            </blockquote>

            <blockquote>
                <b>Observaciones: </b> <br>
                {{ $data->observations }}
            </blockquote>
        </div>
    
    </div>

@stop
