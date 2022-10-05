@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Sistemas</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('system.companies') }}">Empresas</a></li>
                <li class="breadcrumb-item"><a href="{{ route('system.companies.edit',['id'=>$id]) }}">Actualizar</a></li>
            </ol>
        </nav>
    @stop

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Actualizar</h3>
          <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('system.companies.update',['id'=>$id]) }}" method="POST">
                @csrf
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Nombre comercial" name="name" maxlength="255" value="{{ $company->name }}" placeholder="Capture el nombre comercial" required />
                </div>
    
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Razon social" name="business_name" maxlength="255" value="{{ $company->business_name }}" placeholder="Capture la razon social"  />
                </div>

                <div class="col-sm-12">
                    <x-dg-input type="text" label="Representate legal" name="legal_representative" id="legal_representative" maxlength="255" value="{{ $company->legal_representative }}" placeholder="Capture la razon social"  />
                </div>

                <div class="col-sm-12">
                    <label for="public_deed">Escritura pública</label>
                    <textarea name="public_deed" id="public_deed" maxlength="255" class="form-control" placeholder="Capture la escritura pública">{{ $company->public_deed }}</textarea>
                </div>
    
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Direccion" name="address" maxlength="255" value="{{ $company->address }}" placeholder="Capture la dirección"  />
                </div>
                
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Código Postal" name="zip_code" maxlength="255" value="{{ $company->zip_code }}" placeholder="Capture el código postal"  />
                </div>
    
                <div class="col-sm-12 p-2 d-flex justify-content-between">
                    
                    <a href="{{ route('system.companies') }}" class="btn btn-default">
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
