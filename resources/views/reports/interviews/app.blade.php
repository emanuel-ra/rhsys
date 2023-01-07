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
                <div class="card-body">
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
