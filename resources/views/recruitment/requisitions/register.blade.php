@extends('app')

@section('plugins.imask', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Recursos Humanos</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('recruitment.requisitions') }}">Reclutamiento</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitment.requisitions.form.create') }}">Requisiciones</a></li>
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

           
            <form action="{{ route('recruitment.requisitions.store') }}" method="POST">
                @csrf

                <div class="row p-2">

                    <div class="form-group col-12 col-lg-6">
                        <label for="company_id">Empresa</label>
                        <select name="company_id" id="company_id" class="form-control" required onchange="GetBranches(this.value,'{{ csrf_token() }}','branch_id','{{ url('') }}')">
                            <option value=""></option>
                            @foreach ($companies as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="form-group col-12 col-lg-6">
                        <label for="branch_id">Sucursal</label>
                        <select name="branch_id" id="branch_id" class="form-control" required>
                            <option value=""></option>                      
                        </select>
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="">Departamento</label>
                        <select name="department_id" id="department_id" class="form-control" onchange="GetJopPositions(this.value,'{{ csrf_token() }}','jop_position_id','{{ url('') }}')">
                            <option value=""></option>
                            @foreach ($departments as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-12 col-lg-6">
                        <label for="">Puesto</label>
                        <select name="jop_position_id" id="jop_position_id" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="">Solicita</label>
                        <select name="supervisor_id" id="supervisor_id" class="form-control">
                            <option value=""></option>
                            @foreach ($Staff as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
               
                    <div class="col-sm-12 col-md-3">
                        <label for="">Cantidad</label>
                        <input type="number" class="form-control" name="request_quantity" value="{{old('quantity')}}" required >
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <x-dg-input-date id="request_date" name="request_date" label="Fecha Nacimiento" value="{{old('born_date')}}" required />
                    </div>

                    <div class="form-group col-12">
                        <label for="">Observaciones</label>
                        <textarea name="commentaries" maxlength="500" class="form-control"></textarea>
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
