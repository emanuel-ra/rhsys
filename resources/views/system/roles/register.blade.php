@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Sistemas</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('system.roles') }}">Roles</a></li>
                <li class="breadcrumb-item"><a href="{{ route('system.roles.register') }}">Registrar</a></li>
            </ol>
        </nav>
    @stop

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Registro Nuevo</h3>
          <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('system.roles.store') }}" method="POST">
                @csrf
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Nombre del Rol" name="name" maxlength="255" placeholder="Capture el nombre del rol" required />
                </div>
                

                <div class="row">
                    @foreach ($permissions as $item)
                        <div class="com-sm-12 col-lg-3 form-check ">
                            <input class="form-check-input" type="checkbox" value="{{ $item->id }}" name="permission_id[]" id="permission_{{ $item->id }}">
                            <label class="form-check-label" for="permission_{{ $item->id }}">{{ $item->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="row">
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
                    
                    <a href="{{ route('system.roles') }}" class="btn btn-default">
                        Cancelar
                    </a>

                    <button class="btn btn-primary">
                        Guardar
                    </button>
                </div>
    
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

@stop
