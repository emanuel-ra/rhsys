@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('hr.staff') }}">Recursos Humanos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Personal</li>
            </ol>
        </nav>
    @stop

    <div class="col-sm-12 p-2 d-flex justify-content-end">
        @can('users.create')
            <a href="{{ route('hr.staff.register') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>          
                Dar de alta
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
            <div class="col-12">
                {{ $data->links('pagination::bootstrap-4') }}
            </div>

            <table id="table_records" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Nombre</th>                        
                        <th>Contacto</th>                        
                        <th>Empresa</th>                        
                        <th>Departamento</th>
                        <th>Ingreso</th>
                        <th>Creado</th>
                        <th>Estatus</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                Email:<a href="mailto:{{ $item->email }} ">{{ $item->email }} </a><br>
                                Tel:<a href="tel:+52{{ $item->mobile_phone }}">{{ $item->mobile_phone }}</a>
                            </td>
                            <td>{{ $item->company->name }} <br> {{ $item->branch->name }}</td>                            
                            <td>
                                {{ $item->department->name }} <br>
                                <b>Puesto: </b>{{ $item->position->name }} <br>
                                <b>Supervisor: </b>{{ ($item->supervisor) ? 'si':'no' }}                                
                            </td>
                            <td>
                                {{ $item->hired_date }} <br>
                                <b>Antiguedad: </b> 
                                <span class="badge badge-info">
                                    {{  \Carbon\Carbon::parse($item->hired_date)->age }} Años
                                </span>
                            </td>
                            <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                            <td class="{{ ($item->status_id == 4) ? 'text-success':'text-danger' }}">{{ $item->status->name }}</td>
                            <td>
                                <div class="dropdown dropleft show">
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @can('users.update')
                                            <li>                                                
                                                <a class="dropdown-item" href="{{ route('hr.staff.edit',['id' => $item->id]) }}">
                                                    <i class="fas fa-user-edit"></i> Editar
                                                </a>
                                            </li>
                                        @endcan   
                                        
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
                                            
                                        @endcan
                                        
                                    </div>
                                </div>
                            </td>                        
                        </tr>
                   @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Clave</th>
                        <th>Nombre</th>                        
                        <th>Correo</th>                        
                        <th>Empresa</th>                        
                        <th>Departamento</th>
                        <th>Ingreso</th>
                        <th>Creado</th>
                        <th></th>
                    </tr>
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
