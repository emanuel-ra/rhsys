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

        <button class="btn btn-info mr-2" onclick="document.getElementById('form_filters').submit();">
            <i class="fa fa-search"></i>
        </button>    

        @can('users.create')
            <a href="{{ route('hr.staff.register') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>          
                Nueva de alta
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
            
            <form action="{{ route('hr.staff') }}" method="post" id="form_filters" class="row">    
                @csrf           
                <div class="col-12 col-lg-3">
                    <label for="branch_id">Sucursal</label>
                    <select name="branch_id" id="branch_id" class="form-control">
                        <option value=""></option>
                        @foreach ($branches as $item)
                            <option {{ ($item->id == $branch_id) ? 'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <label for="department_id">Departamento</label>
                    <select name="department_id" id="department_id" class="form-control">
                        <option value=""></option>
                        @foreach ($departments as $item)
                            <option {{ ($item->id == $department_id) ? 'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <label for="jop_position_id">Puesto</label>
                    <select name="jop_position_id" id="jop_position_id" class="form-control">
                        <option value=""></option>
                        @foreach ($jop_positions as $item)
                            <option {{ ($item->id == $jop_position_id) ? 'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
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

                <div class="col-12 mt-2">
                    <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">
                        <i class="fa fa-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar..." name="searchKeyword" value="{{ $keyword }}" aria-describedby="addon-wrapping">
                    </div>
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
                        <th>Clave</th>
                        <th>Checador</th>
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
                            <td>{{ $item->checker_code }}</td>
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
                                        
                                        @can('staff.pdf.contract')
                                            <li>                                                
                                                <a class="dropdown-item" target="_blank" href="{{ route('hr.staff.pdf.specific.contract',['id' => $item->id]) }}">
                                                    <i class="fas fa-file-pdf"></i> Contrato Determinado
                                                </a>
                                            </li>

                                            <li>                                                
                                                <a class="dropdown-item" target="_blank" href="{{ route('hr.staff.pdf.indeterminate.period.contract',['id' => $item->id]) }}">
                                                    <i class="fas fa-file-pdf"></i> Contrato Indeterminado con periodo de prueba
                                                </a>
                                            </li>

                                            <li>                                                
                                                <a class="dropdown-item" target="_blank" href="{{ route('hr.staff.pdf.indeterminate.contract',['id' => $item->id]) }}">
                                                    <i class="fas fa-file-pdf"></i> Contrato Indeterminado
                                                </a>
                                            </li>

                                        @endcan  
                                      
                                        @can('staff.pdf.personal.data')
                                            <li>                                                
                                                <a class="dropdown-item" target="_blank" href="{{ route('hr.staff.pdf.personal.data',['id' => $item->id]) }}">
                                                    <i class="fas fa-file-pdf"></i> Datos Personales
                                                </a>
                                            </li>
                                        @endcan  

                                        @can('users.update')
                                            @if ($item->status_id == 4)
                                                <div class="dropdown-divider"></div>   
                                                <li>                                                
                                                    <a class="dropdown-item" href="{{ route('hr.staff.edit',['id' => $item->id]) }}">
                                                        <i class="fas fa-user-edit"></i> Editar
                                                    </a>
                                                </li>
                                            @endif
                                        @endcan   
                                        
                                        @can('users.update')
                                            <div class="dropdown-divider"></div>       
                                            <a class="dropdown-item" href="{{route('hr.staff.view',['id'=> $item->id])}}">
                                                <i class="fas fa-id-card"></i> Ver kardex
                                            </a>
                                        @endcan
                                             
                                        @can('staff.vacations.request')
                                            @if ($item->status_id == 4)
                                                <div class="dropdown-divider"></div>    
                                                <li>                                                
                                                    <a class="dropdown-item" href="{{ route('hr.staff.vacations.request',['id' => $item->id]) }}">
                                                        <i class="fas fa-umbrella-beach"></i> Solicitud de Vacaciones
                                                    </a>
                                                </li>
                                            @endif
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
                        <th>Checador</th>
                        <th>Nombre</th>                        
                        <th>Contacto</th>                        
                        <th>Empresa</th>                        
                        <th>Departamento</th>
                        <th>Ingreso</th>
                        <th>Creado</th>
                        <th>Estatus</th>
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
