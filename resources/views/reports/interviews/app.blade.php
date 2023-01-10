@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Reportes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Entrevistas</li>
            </ol>
        </nav>      
    @stop

    @section('content')
        <div class="row">
            <div class="card col-12">
                <div class="card-header">
                    <h4>CITAS PARA ENTREVISTA</h4>
                    <div class="card-tools">
                        <!-- Maximize Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('reports.interviews') }}">
                        <div class="col-12 mt-2">
                            <div class="row">
                                
                                <div class="form-group col-12 col-lg-2">
                                    <label for="">Fecha Inicio</label>
                                    <div class="input-group date" id="date_from" data-target-input="nearest">                            
                                        <div class="input-group-append" data-target="#date_from" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div> 
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date_from" data-toggle="datetimepicker" name="date_from" value="{{ $date_from }}"/>
                                    </div>
                                </div>
                                
                                <div class="form-group col-12 col-lg-2">
                                    <label for="">Fecha Fin</label>
                                    <div class="input-group date" id="date_to" data-target-input="nearest">                            
                                        <div class="input-group-append" data-target="#date_to" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div> 
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date_to" data-toggle="datetimepicker" name="date_to" value="{{ $date_to }}"/>
                                    </div>
                                </div>

                                <div class="form-group col-12 col-lg-2">   
                                    <label for="user_id">Usuario</label>                             
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="0"></option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12 col-lg-2">
                                    <label for="branch_id">Sucursal</label>
                                    <select name="branch_id" id="branch_id" class="form-control">                                    
                                        <option value="0"></option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12 col-lg-2">
                                    <label for="jop_position_id">Puestos</label>
                                    <select name="jop_position_id" id="jop_position_id" class="form-control">
                                        <option value="0"></option>
                                        @foreach ($jop_positions as $jop_position)
                                            <option value="{{ $jop_position->id }}">{{ $jop_position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-12 p-2">
                                    <button class="btn btn-primary float-right">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                                
                            </div>
                           
                        </div>
                    </form>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Entrevisto</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Puesto</th>
                                <th>Fecha Entrevista</th>
                                <th>Sucursal</th>
                                <th>Fuente</th>
                                <th>¿Asistio?</th>
                                <th>Enc. Área <br> Aceptadi/Rechazado</th>                               
                                <th>Contratado</th>
                                <th>Fecha de Contratación</th>
                                <th>Comentarios</th>
                                <th>Observaciones</th>                                
                            </tr>
                        </thead>
                        <tbody>                            
                            @if (count($interviews))
                                @foreach ($interviews as $item)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->candidate->name }}</td>
                                        <td>{{ $item->candidate->mobile_phone }}</td>
                                        <td>{{ $item->candidate->email }}</td>
                                        <td>{{ $item->candidate->requisitions->position->name }}</td>
                                        <td>{{ $item->interview_date }}</td>
                                        <td>{{ $item->candidate->requisitions->branch->name }}</td>
                                        <td>{{ $item->candidate->candidatesource->name }}</td>
                                        <td>{{ ($item->attendance) ? 'Si':'No' }}</td>
                                        <td>
                                            @if (!$item->candidate->is_accepted)
                                                <span class="text-warning">Pendiente</span>
                                            @endif
                                            @if ($item->candidate->is_accepted==1)
                                                <span class="text-success">Aceptado</span>
                                            @endif
                                            @if ($item->candidate->is_accepted==2)
                                                <span class="text-danger">Rechazado</span>
                                            @endif
                                        </td>                                      
                                        <td>
                                            @if (!$item->candidate->is_hired)
                                                <span class="text-warning">Pendiente</span>
                                            @endif
                                            @if ($item->candidate->is_hired==1)
                                                <span class="text-success">Si</span>
                                            @endif
                                            @if ($item->candidate->is_hired==2)
                                                <span class="text-danger">No</span>
                                            @endif                                            
                                        </td>
                                        <td>
                                            @if ($item->candidate->is_hired)
                                                {{$item->candidate->hired_date}}
                                            @endif
                                        </td>
                                        <td>{{ $item->commentaries }}</td>
                                        <td>{{ $item->observations }}</td>
                                    </tr>
                                @endforeach 
                            @endif
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    @stop

@stop

@section('js')
    <script>
        $(function () {
            $('#date_from').datetimepicker({
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                format: 'YYYY-MM-DD'
            });

            $('#date_to').datetimepicker({
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                format: 'YYYY-MM-DD'
            });
        });   
    </script>
@endsection
