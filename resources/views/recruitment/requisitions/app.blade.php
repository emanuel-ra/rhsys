@extends('app')

@section('plugins.Sweetalert2', true)


@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('recruitment.requisitions') }}">Reclutamiento</a></li>
                <li class="breadcrumb-item active" aria-current="page">Requisiciones</li>
            </ol>
        </nav>
    @stop

    <div class="col-sm-12 p-2 d-flex justify-content-end">

        <button class="btn btn-info mr-2" onclick="document.getElementById('form_filters').submit();">
            <i class="fa fa-search"></i>
        </button>    

        @can('users.create')
            <a href="{{ route('recruitment.requisitions.form.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>          
                Nueva de Requisicion
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
            </form>
           
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
                        <th>Empresa</th>
                        <th>Sucursal</th>
                        <th>Departamento</th>                        
                        <th>Puesto</th>                        
                        <th>Fecha Solicitud</th>
                        <th>Fecha Completado</th>
                        <th>Vacante</th>                        
                        <th>Ingresos</th>
                        <th>Solicitante</th>
                        <th>Dias Transcurridos</th>
                        <th>Estatus</th>
                        <th>Registro</th>
                        <th>Cancelación</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($data as $item)
                        @php
                           $diff = now()->diffInDays(Carbon\Carbon::parse($item->request_date));                           
                        @endphp
                        <tr>
                            <td>{{ $item->company->name }}</td>
                            <td>{{ $item->branch->name }}</td>
                            <td>{{ $item->department->name }}</td>
                            <td>{{ $item->position->name }}</td>
                            <td>{{ $item->request_date }}</td>
                            <td>{{ $item->closed_date }}</td>
                            <td>{{ $item->request_quantity }}</td>
                            <td>{{ $item->hired_quantity }}</td>
                            <td>{{ $item->supervisor->name }}</td>
                            <td>{{ $diff }}</td>                            
                            <td>{{ $item->status->name }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                <b>Por:</b> {{ @$item->usercancel->name }}                                
                                <br>
                                <b>Fecha:</b> {{ $item->cancel_date }}                                
                                <br>
                                    <a href="javascript:Swal.fire('{{ $item->cancelation_reason }} ')">
                                        {{ substr($item->cancelation_reason,0 , 20); }}
                                    </a>
                                <br>

                            </td>
                            <td>
                                <div class="dropdown dropleft show">
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @can('recruitment.requisitions.cancel')
                                            @if ($item->status_id==1)
                                                <li>                                                
                                                    <a class="dropdown-item" href="javascript:requisition.modal.cancelation.open(
                                                        {
                                                            id:{{ $item->id }} ,
                                                            title: '{{ $item->company->name }} / {{ $item->branch->name }} / {{ $item->department->name }} / {{ $item->position->name }}'
                                                        }                                                        
                                                        )">
                                                        <i class="fas fa-ban"></i> Cancelar
                                                    </a>
                                                </li>
                                                
                                            @endif
                                        @endcan  

                                        @can('recruitment.requisitions.complete')
                                            @if ($item->status_id==1)
                                                <div class="dropdown-divider"></div>                                   
                                                <li>                                                
                                                    <a class="dropdown-item" href="{{ route('recruitment.requisitions.complete',['id'=>$item->id]) }}">
                                                        <i class="fas fa-check"></i> Completado
                                                    </a>
                                                </li>                                                
                                            @endif
                                        @endcan  

                                       

                                        {{-- @can('staff.contract')
                                        <li>                                                
                                            <a class="dropdown-item" target="_blank" href="{{ route('hr.staff.pdf.contract',['id' => $item->id]) }}">
                                                <i class="fas fa-file-pdf"></i> Contrato
                                            </a>
                                        </li>
                                        @endcan  

                                        @can('users.update')
                                            <div class="dropdown-divider"></div>   
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
                                            
                                        @endcan --}}
                                        
                                    </div>
                                </div>
                            </td>                        
                        </tr>
                   @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Empresa</th>
                        <th>Sucursal</th>
                        <th>Departamento</th>                        
                        <th>Puesto</th>                        
                        <th>Cantidad Requerida</th>                        
                        <th>Fecha Solicitud</th>
                        <th>Solicitante</th>
                        <th>Dias Transcurridos</th>
                        <th>Estatus</th>
                        <th>Registro</th>
                        <th>Cancelación</th>
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

    @include('recruitment.requisitions.modal.cancel')    
      
    @section('js')
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>        
    @endsection
 
@stop
