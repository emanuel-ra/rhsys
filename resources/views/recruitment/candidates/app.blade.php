@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('recruitment.candidates') }}">Reclutamiento</a></li>
                <li class="breadcrumb-item active" aria-current="page">Candidatos</li>
            </ol>
        </nav>
    @stop

    <div class="col-sm-12 p-2 d-flex justify-content-end">

        <button class="btn btn-info mr-2" onclick="document.getElementById('form_filters').submit();">
            <i class="fa fa-search"></i>
        </button>    

        @can('users.create')
            <a href="{{ route('recruitment.candidates.form.create') }}" class="btn btn-primary mr-2">
                <i class="fa fa-plus"></i>          
                Nueva Candidato
            </a>
        @endcan    
        
        <a href="{{ route('recruitment.candidates.charts') }}" class="btn btn-info">
            <i class="fas fa-chart-bar"></i>  
            Graficas
        </a>

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
            
            <form action="{{ route('recruitment.candidates') }}" method="post" id="form_filters" class="row">    
                @csrf           
                
                <div class="col-12 col-lg-3">
                    <label for="">Buscar por</label>
                    <input type="text" class="form-control" name="keyWords" value="{{ $keyWords }}" placeholder="(Nombre, Correo, Email)">
                </div>

                <div class="col-12 col-lg-3">
                    <label for="status_id">Estatus</label>
                    <select name="status_id" id="status_id" class="form-control">
                        <option value="0"></option>
                        @foreach ($status as $item)
                            <option {{ ($item->id == $status_id) ? 'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <label for="status_id">Fuente</label>
                    <select name="source_id" id="source_id" class="form-control">
                        <option value="0"></option>
                        @foreach ($sources as $item)
                            <option {{ ($item->id == $source_id) ? 'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
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
                        <th>Aceptación</th>
                        <th>Contratación</th>
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
                            <td>{{ $item->candidatesource->name }}</td>
                            <td>{{ $item->status->name }}</td>
                            <td>
                                @if ($item->is_accepted==0)
                                    <span class="text-warning">Pendiente</span>                                    
                                @endif
                                @if ($item->is_accepted==1)
                                    <span class="text-success">Aceptado</span>
                                @endif
                                @if ($item->is_accepted==2)
                                    <span class="text-danger">Rechazado</span>                       
                                @endif
                            </td>
                            <td>
                                @if ($item->is_hired==0)
                                    <span class="text-warning">Pendiente</span>                                    
                                @endif
                                @if ($item->is_hired==1)
                                    <span class="text-success">Contratado</span>
                                @endif
                                @if ($item->is_hired==2)
                                    <span class="text-danger">No Contratado</span>                       
                                @endif 
                            </td>
                            <td>
                                <div class="dropdown dropleft show">
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        
                                        @can('recruitment.candidates.tracing')

                                            <li>                                                
                                                <a class="dropdown-item" href="{{ route('recruitment.candidates.form.tracing',['id' => $item->id]) }}">
                                                    <i class="fas fa-network-wired"></i> Seguimiento
                                                </a>
                                            </li>
                                            <div class="dropdown-divider"></div> 
                                            

                                            @if ( $item->status_id==1 && $item->is_hired==0 && $item->is_accepted==0)
                                                <li>                                                
                                                    <a class="dropdown-item" href="{{ route('recruitment.candidates.set.archive',['id' => $item->id]) }}">
                                                        <i class="fas fa-door-closed"></i> Archivar
                                                    </a>
                                                </li>
                                                <div class="dropdown-divider"></div> 
                                            @endif

                                            @if ( $item->status_id==10)                                                
                                                <li>                                                
                                                    <a class="dropdown-item" href="{{ route('recruitment.candidates.set.active',['id' => $item->id]) }}">
                                                        <i class="fas fa-door-open"></i> Activar
                                                    </a>
                                                </li>
                                                <div class="dropdown-divider"></div>  
                                            @endif

                                        @endcan  

                                        @can('recruitment.candidates.update')
                                            @if ( $item->is_hired==0 || $item->is_accepted==0)
                                                <li>                                                
                                                    <a class="dropdown-item" href="{{ route('recruitment.candidates.form.edit',['id' => $item->id]) }}">
                                                        <i class="fas fa-user-edit"></i> Editar
                                                    </a>
                                                </li>
                                                <div class="dropdown-divider"></div>  
                                            @endif
                                        @endcan   

                                        @can('recruitment.candidates.update')
                                            @if ( $item->is_hired==0 || $item->is_accepted==0)
                                                <li>                                                
                                                    <a class="dropdown-item" href="{{ route('recruitment.interview.form.create',['id' => $item->id]) }}">
                                                        <i class="fas fa-calendar-plus"></i> Agendar Entrevista
                                                    </a>
                                                </li>
                                                <div class="dropdown-divider"></div>  
                                            @endif
                                        @endcan  
                                        
                                        @if ($item->cv_file!=null)
                                           
                                            <a class="dropdown-item" href="{{ '/cv/'.$item->cv_file }}" target="_blank">
                                                <i class="fa fa-file-pdf"></i> Curriculum Vitae
                                            </a>    
                                        @endif                                       
                                        
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
