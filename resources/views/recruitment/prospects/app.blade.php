@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('recruitment.prospects') }}">Reclutamiento</a></li>
                <li class="breadcrumb-item active" aria-current="page">Prospectos</li>
            </ol>
        </nav>
    @stop

    <div class="col-sm-12 p-2 d-flex justify-content-end">

        <button class="btn btn-info mr-2" onclick="document.getElementById('form_filters').submit();">
            <i class="fa fa-search"></i>
        </button>    

        @can('users.create')
            <a href="{{ route('recruitment.prospects.form.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>          
                Nueva Prospecto
            </a>
        @endcan            
    </div>

    <div class="card col-12">
        <div class="card-header">
            <h3 class="card-title">Filtros</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                {{-- <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button> --}}
            </div>
        </div>
        <div class="card-body">
            
            <form action="{{ route('recruitment.requisitions') }}" method="post" id="form_filters" class="row">    
                @csrf           
                
                <div class="col-12 col-lg-3">
                    <label for="status_id">Estatus</label>
                    <select name="status_id" id="status_id" class="form-control">
                        <option value=""></option>
                        @foreach ($status as $item)
                            <option {{ ($item->id == $status_id) ? 'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <label for="status_id">Estatus</label>
                    <select name="status_id" id="status_id" class="form-control">
                        <option value=""></option>
                        @foreach ($status as $item)
                            <option {{ ($item->id == $status_id) ? 'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <label for="status_id">Estatus</label>
                    <select name="status_id" id="status_id" class="form-control">
                        <option value=""></option>
                        @foreach ($status as $item)
                            <option {{ ($item->id == $status_id) ? 'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

            </form>
           
        </div>
    </div>
    
    <div class="card  col-12">
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
            <div class="col-12">
                {{ $data->links('pagination::bootstrap-4') }}
            </div>

            <table id="table_records" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Email</th>                        
                        <th>Vacante</th>                        
                        <th>Fuente</th>                        
                        <th>Estatus</th>                        
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($data as $item)
                        @php
                           $diff = now()->diffInDays(Carbon\Carbon::parse($item->request_date));                           
                        @endphp
                        <tr>
                            
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->mobile_phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                {{ $item->requisitions->branch->name }} <br>
                                <b>{{ $item->requisitions->position->name }}</b>
                            </td>
                            <td>{{ $item->prospectsource->name }}</td>
                            <td>{{ $item->status->name }}</td>
                            <td>
                                <div class="dropdown dropleft show">
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        
                                        @can('recruitment.prospects.tracing')
                                            <li>                                                
                                                <a class="dropdown-item" href="{{ route('recruitment.prospects.form.tracing',['id' => $item->id]) }}">
                                                    <i class="fas fa-network-wired"></i> Seguimiento
                                                </a>
                                            </li>
                                        @endcan  

                                        @can('recruitment.prospects.update')
                                            <div class="dropdown-divider"></div>  

                                            <li>                                                
                                                <a class="dropdown-item" href="{{ route('recruitment.prospects.form.edit',['id' => $item->id]) }}">
                                                    <i class="fas fa-user-edit"></i> Editar
                                                </a>
                                            </li>
                                        @endcan   
                                        
                                        {{--

                                       
                                        @can('users.update')
                                            <div class="dropdown-divider"></div>       
                                            <a class="dropdown-item" href="{{route('hr.staff.view',['id'=> $item->id])}}">
                                                <i class="fas fa-id-card"></i> Ver kardex
                                            </a>
                                        @endcan
                                             
                                        @can('staff.unsubscribe')     
                                            <div class="dropdown-divider"></div>                                   
                                            @if ($item->status_id == 4)
                                                <a class="dropdown-item" href="{{ route('hr.staff.unsubscribe',['id' => $item->id]) }}"><i class="fas fa-user-slash text-danger"></i> Dar de Baja</a>    
                                            @endif
                                            
                                        @endcan --}}
                                        
                                    </div>
                                </div>
                            </td>                        
                        </tr>
                   @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Email</th>                        
                        <th>Vacante</th>                        
                        <th>Fuente</th>                        
                        <th>Estatus</th>                        
                        <th></th>
                    </tr>                   
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="col-12">
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <!-- /.card -->
      
    @section('js')
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>        
    @endsection
 
@stop
