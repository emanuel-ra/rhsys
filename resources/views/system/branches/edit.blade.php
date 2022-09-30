@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Sistemas</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('system.branches') }}">Sucursales</a></li>
                <li class="breadcrumb-item"><a href="{{ route('system.branches.edit',['id'=>$id]) }}">Actualizar</a></li>
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
            <form action="{{ route('system.branches.update',['id'=>$id]) }}" method="POST">
                @csrf
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Nombre comercial" name="name" maxlength="255" value="{{ $data->name }}" placeholder="Capture el nombre comercial" required />
                </div>
                
                
                <div class="col-sm-12 form-group">
                    <label for="">Empresa</label>
                    <select id="company_id" name="company_id" class="form-control" required onchange="GetStates(this.value,'{{ csrf_token() }}','state_id')">        
                        <option value=""></option>
                        @foreach ($companies as $item)
                            <option {{ ($item->id==$data->company_id) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

    
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Direccion" name="address" maxlength="255" value="{{ $data->address }}" placeholder="Capture la dirección"  />
                </div>
                
                <div class="col-sm-12">
                    <x-dg-input type="text" label="Código Postal" name="zip_code" maxlength="255" value="{{ $data->zip_code }}" placeholder="Capture el código postal"  />
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
