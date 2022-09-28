@extends('app')

@section('plugins.imask', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Recursos Humanos</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('hr.staff') }}">Personal</a></li>
                <li class="breadcrumb-item"><a href="{{ route('hr.staff.view',['id'=>$data->id]) }}">Vista</a></li>
            </ol>
        </nav>
    @stop

    <div class="card card-primary card-outline">
        <div class="card-header no-print">
            <h3 class="card-title"></h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                </button>
            </div>            
        </div>

        <div class="card-body">
            <div class="border position-relative p-3 mb-3">

                <div class="ribbon-wrapper ribbon-sm">
                    <div class="ribbon {{ ($data->status_id ==4) ? 'bg-success':'bg-danger' }} text-sm">
                        {{$data->status->name}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-globe"></i> {{ $data->code }} - {{ $data->name }}.
                        </h4>
                    </div>                    
                </div>

                
                
                <div class="row invoice-info">
                    <div class="col-12 col-sm-4 mt-2">
                        <h4> Direccion y Contacto</h4>
                        <address>
                            <strong>{{ $data->country->name }},@if ($data->state != null) {{$data->state->name}} @endif.</strong><br>
                            @if ($data->address!='')
                            {{ $data->address }},    
                            @endif
                            @if ($data->suburb!='')
                            {{ $data->suburb }},  <br> 
                            @endif

                            @if ($data->town!='')
                            {{ $data->town }},    
                            @endif

                            @if ($data->city!='')
                            {{ $data->city }},    <br>
                            @endif

                            @if ($data->zip_code!='')
                            {{ $data->zip_code }},    <br>
                            @endif
                            <strong>Phone</strong> {{ $data->mobile_phone }} <br>
                            <strong>Email</strong>: {{ $data->email }}
                        </address>
                    </div>
                    <div class="col-12 col-sm-4 mt-2">
                        <h4></h4>
                        <section>
                            <strong>Razon Social: </strong>{{ $data->company->name }}, <br>
                            <strong>Sucursal: </strong>{{ $data->branch->name }}<br>
                            <strong>Departamento: </strong>{{ $data->department->name }}<br>
                            <strong>Puesto: </strong>{{ $data->position->name }}<br>                           
                            <strong>Escolaridad: </strong>{{ $data->scholarship->name }}<br>      
                            <strong>Estado civil: </strong>{{ $data->maritalstatus->name }}<br>    
                            <strong>Socioeconomico: </strong>{{ ($data->socioeconomic) ? 'Si':'No' }}<br>                           
                        </section>
                    </div>

                    <div class="col-12 col-sm-4 mt-2">
                        <h4></h4>
                        <section>
                            <strong>CURP: </strong>{{ $data->curp }}, <br>
                            <strong>RFC: </strong>{{ $data->rfc }}<br>
                            <strong>Número seguro social: </strong>{{ $data->nss }}<br>
                            <strong>Cuanta Bancaria: </strong>{{ $data->bank_account }}<br>
                            <strong>Genero: </strong>{{ $data->genre }}<br>     
                            <strong>Fecha de Nacimiento: </strong>{{ $data->born_date }}<br>
                            <strong>Edad: </strong>{{ Carbon\Carbon::parse($data->born_date)->age }}<br>
                            <strong>Fecha de Ingreso: </strong>{{ $data->hired_date }}<br>
                            <strong>Antiguedad: </strong>{{ Carbon\Carbon::parse($data->hired_date)->age }}<br>

                        </section>
                    </div>
                </div>       
                
                @if ($data->status_id == 5)
                    <div class="callout callout-danger">
                        <h5>Motivo Baja</h5>
                        @if ($data->reason_unsubscribe_id>0)
                            <b>{{ $data->unsubscribe->name }}</b>    
                        @endif
                        @if ($data->reason_unsubscribe_id==0)
                            <b>Otros</b>
                        @else
                            <b>Otros</b>
                        @endif
                        <blockquote class="quote-warning">{{ $data->reason_unsubscribe_text }}</blockquote>
                    </div>
                @endif
                
                
                @include('human-resources.staff.include.timeline',[
                    'logs' => $data->stafflogs ,
                ])

                <div class="row no-print">
                    <div class="col-12">
                        <a href="javascript:window.print();" rel="noopener" class="btn btn-default"><i class="fas fa-print"></i> Print</a> 

                        @can('staff.index')
                            <a href="{{ route('hr.staff') }}" rel="noopener" class="btn btn-default">
                                <i class="fas fa-list-ol"></i>
                                Ir al listado
                            </a>     
                        @endcan
                        
                        @can('staff.update')
                            <a href="{{ route('hr.staff.edit',['id'=>$data->id]) }}" rel="noopener" class="btn btn-info">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>     
                        @endcan

                        @can('staff.unsubscribe')
                            @if ($data->status_id == 4)
                                <a href="{{ route('hr.staff.unsubscribe',['id'=>$data->id]) }}" rel="noopener" class="btn btn-danger">
                                    <i class="fas fa-user-slash"></i> 
                                    Dar de Baja
                                </a>     
                            @else                            
                        @endcan
                                                    
                        {{-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </button> --}}
                    </div>
                </div>

                

            </div>
            
        </div>
    
    </div>

@stop
