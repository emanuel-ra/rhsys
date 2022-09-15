@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Sistemas</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('system.branches') }}">Sucursales</a></li>
                <li class="breadcrumb-item"><a href="{{ route('system.branches.register') }}">Registrar</a></li>
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
            <form action="{{ route('system.branches.store') }}" method="POST">
                @csrf
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Nombre comercial" name="name" maxlength="255" placeholder="Capture el nombre comercial" required />
                </div>
    
                <div class="col-sm-12">
                    <x-dg-select id="company_id" name="company_id" label="Empresa" required>
                        <x-dg-option   value=""></x-dg-option>
                        @foreach ($companies as $item)
                            <x-dg-option   value="{{ $item->id }}">{{ $item->name }}</x-dg-option>
                        @endforeach
                    </x-dg-select>
                </div>
    
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Direccion" name="address" maxlength="255" placeholder="Capture la dirección"  />
                </div>
                
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Código Postal" name="zip_code" maxlength="255" placeholder="Capture el código postal"  />
                </div>
    
                <div class="col-sm-12 p-2 d-flex justify-content-between">
                    
                    <a href="{{ route('system.branches') }}" class="btn btn-default">
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
