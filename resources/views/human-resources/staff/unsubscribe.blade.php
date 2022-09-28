@extends('app')

@section('plugins.imask', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Recursos Humanos</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('hr.staff') }}">Personal</a></li>
                <li class="breadcrumb-item"><a href="{{ route('hr.staff.unsubscribe',['id'=>$data->id]) }}">Baja de Personal</a></li>
            </ol>
        </nav>
    @stop

    <div class="card card-danger card-outline">
        <div class="card-header">
            <h3 class="card-title">Baja de personal</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                </button>
            </div>            
        </div>

        <div class="card-body">

            <div class="callout callout-info">
                <b>Empleado:</b> [{{ $data->code }}] {{ $data->name }} 
            </div>

            <form action="{{ route('hr.staff.post.unsubscribe',['id'=>$data->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="form-group">
                    <label for="">Motivo baja</label>
                    <select name="reason_unsubscribe_id" id="reason_id" class="form-control" required>                        
                        <option value=""></option>
                        @foreach ($ReasonsToLeaveWork as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        <option value="0">Otros</option>
                    </select>                    
                </div>

                <div class="form-group">
                    <label for="">Otro motivo de baja</label>
                    <textarea class="form-control" name="reason_unsubscribe_text"></textarea>
                    <span class="text-danger font-bold">Capturar si la opcion no se encuentra en la lista desplegable o para complementar la información</span>
                </div>

            
                @if ($errors->any())
                    <div class="col-12 alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        

                <div class="col-12 alert alert-warning " role="alert">
                    <i class="fas fa-exclamation-triangle"></i>  
                    <span class="font-bold">
                        Verifica los datos datos antes de continuar
                    </span>
                </div>
                    
                <div class="col-sm-12 p-2 d-flex justify-content-between">
                    
                    <a href="{{ route('hr.staff') }}" class="btn btn-default">
                        Cancelar
                    </a>

                    <button class="btn btn-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        Dar de Baja
                    </button>
                </div>
                
            </form>
        </div>
    
    </div>

@stop
