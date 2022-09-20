@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Recursos Humanos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Puestos</li>
            </ol>
        </nav>
    @stop

    <div class="col-sm-12 p-2 d-flex justify-content-end">
        @can('users.create')
            <a href="{{ route('hr.jop.position.register') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>          
                Crear
            </a>
        @endcan        
    </div>

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Listado</h3>
          <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="table_records" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Creado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <!-- Example split danger button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @can('users.update')
                                            <li><a class="dropdown-item" href="{{ route('hr.jop.position.edit',['id' => $item->id]) }}">Editar</a></li>
                                        @endcan   
                                        {{-- <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Separated link</a></li> --}}
                                    </ul>
                                </div>
                            </td>                        
                        </tr>
                   @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>   
                        <th>Creado</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
      
 
@stop
