@extends('app')

@section('plugins.imask', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Recursos Humanos</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('system.users') }}">Personal</a></li>
                <li class="breadcrumb-item"><a href="{{ route('hr.staff.register') }}">Registrar</a></li>
            </ol>
        </nav>
    @stop

    <div class="card card-tabs">
        <div class="card-header">
            <h3 class="card-title">Registro Nuevo</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>            
        </div>

        <div class="card-body  p-0">

            <div class="col-12 p-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="staff-general-data-tab" data-toggle="pill" href="#staff-general-data" role="tab" aria-controls="staff-general-data" aria-selected="true">Datos Generales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="staff-address-data-tab" data-toggle="pill" href="#staff-address-data" role="tab" aria-controls="staff-address-data" aria-selected="false">Direccion</a>
                    </li>                   
                </ul>
            </div>

            <form action="{{ route('hr.staff.store') }}" method="POST">
                @csrf

                <div class="tab-content p-4" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="staff-general-data" role="tabpanel" aria-labelledby="staff-general-data-tab">
                        <div class="row">
                            @include('human-resources.staff.include.register_general')                        
                        </div>
                    </div>
                    <div class="tab-pane fade" id="staff-address-data" role="tabpanel" aria-labelledby="staff-address-data-tab">
                        <div class="row">
                            @include('human-resources.staff.include.register_address')      
                        </div>
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
                    
                    <a href="{{ route('hr.staff') }}" class="btn btn-default">
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
