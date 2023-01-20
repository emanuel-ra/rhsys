@extends('app')

@section('plugins.imask', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Recursos Humanos</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('hr.staff') }}">Personal</a></li>
                <li class="breadcrumb-item"><a href="{{ route('hr.staff.vacations.request',['id' => $Staff->id]) }}">Solicitud de Vacaciones</a></li>
            </ol>
        </nav>
    @stop

    <div class="card card-tabs">
        <div class="card-header">
            <h3 class="card-title">Solicitud de Vacaciones</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>            
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-12 col-lg-6">
                    <blockquote>
                        <b>Código :</b> {{ $Staff->code }}. <br>
                        <b>Nombre :</b> {{ $Staff->name }}. <br>
                        <b>Departamento :</b> {{ $Staff->department->name }}. <br>
                        <b>Puesto :</b> {{ $Staff->position->name }}. <br>
                        <b>Empresa :</b> {{ $Staff->company->name }}. <br>
                        <b>Sucursal :</b> {{ $Staff->branch->name }}. <br>
                        <b>Fecha de Ingreso :</b> {{ $Staff->hired_date }}. <br>
                        <b>Antiguedad :</b>  {{  $antiquity }} Años. <br>
                    </blockquote>
                </div>

                <div class="col-12 col-lg-6">
                    @if ($antiquity && $available_vacations)
                        <form action="{{ route('hr.staff.vacations.request.store') }}" method="POST" id="vacations_form">
                            @csrf

                            <input type="hidden" name="staff_id" value="{{ $Staff->id }}">

                            <div class="row p-2">

                                <div class="col-sm-12 col-lg-4">
                                    <label for="">Inicio</label>
                                    <div class="input-group date" id="start_date" data-target-input="nearest">                            
                                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div> 
                                        <input type="text" class="form-control datetimepicker-input" data-target="#start_date" data-toggle="datetimepicker" name="start_date" autocomplete="off" required/>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-4">
                                    <label for="">Termino</label>
                                    <div class="input-group date" id="end_date" data-target-input="nearest">                            
                                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div> 
                                        <input type="text" class="form-control datetimepicker-input" data-target="#end_date" data-toggle="datetimepicker" name="end_date" autocomplete="off" required/>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-4">
                                    <label for="">Debera Presentarse</label>
                                    <div class="input-group date" id="come_back_date" data-target-input="nearest">                            
                                        <div class="input-group-append" data-target="#come_back_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div> 
                                        <input type="text" class="form-control datetimepicker-input" data-target="#come_back_date" data-toggle="datetimepicker" name="come_back_date" autocomplete="off" required/>
                                    </div>
                                </div>
                               
                                <div class="col-sm-12">
                                    <label for="">Observaciones</label>
                                    <textarea class="form-control" name="observations"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-sm-12 p-2 d-flex justify-content-between">                             
                                <a href="{{ route('hr.staff') }}" class="btn btn-default">
                                    Cancelar
                                </a>
                                <button class="btn btn-primary" id="set_request_btn">
                                    Guardar
                                </button>
                            </div>

                            <div class="col-12">
                                @if(session('success'))
                                    <div class="col-12 alert alert-success" role="alert">
                                        <h1>{{session('success')}} 😀👍</h1>
                                    </div>                                
                                @endif
                                
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
                
                        </form>
                    @else
                        <div class="alert alert-warning">
                            <h3>Este empleado aun no puede solicitar vacaciones</h3>
                        </div>
                    @endif
                    
                    <div class="col-12" id="alert_container"></div>
                </div>

                <div class="col-12 col-lg-6 border p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> {{ ucfirst(__('words.years of work')) }}</th>
                                <th> {{ ucfirst(__('words.days of vacations')) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($vacations_table))
                                @foreach($vacations_table as $key)                                    
                                    @php
                                        $corresponds = '';
                                        if($key->from === $key->to && $antiquity===$key->to && ($available_vacations)){
                                            $corresponds = 'bg-info';
                                            $corresponds_days = $key->days;
                                        }                                           
                                        if($key->from !== $key->to && $antiquity>=$key->from && $antiquity<=$key->to && ($available_vacations)){
                                            $corresponds = 'bg-info';
                                            $corresponds_days = $key->days;
                                        }
                                            
                                    @endphp
                                    <tr class="{{ $corresponds }}">
                                        <td>
                                            {{ ucfirst(__('vacations-table.'.$key->label)) }}
                                        </td>
                                        <td>
                                            {{ $key->days }} {{ __('words.days') }}
                                        </td>                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="col-12 col-lg-6 border p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ ucfirst(__('words.start')) }}</th>
                                <th>{{ ucfirst(__('words.end2')) }}</th>
                                <th>{{ ucfirst(__('words.come back (hr)')) }}</th>
                                <th>{{ ucfirst(__('words.requested days')) }}</th>
                                <th>{{ ucfirst(__('words.date of elaboration')) }}</th>    
                                <th>Estatus</th>
                                <th></th>                            
                            </tr>
                        </thead>
                        <tbody>                            
                            @if ($Staff->vacations!=null)
                                @foreach($Staff->vacations as $key)                                    
                                    @php
                                        if($year== \Carbon\Carbon::parse($key->start_date)->format('Y'))
                                            $total_days += $key->number_of_requested_days;
                                    @endphp 
                                    <tr class="{{ $corresponds }}">
                                        <td>{{  $key->start_date }}</td>
                                        <td>{{  $key->end_date }}</td>
                                        <td>{{  $key->come_back_date }}</td>
                                        <td>{{  $key->number_of_requested_days }}</td>
                                        <td>{{  $key->created_at }}</td>
                                        <td>{{  $key->status->name }}</td>
                                        <td>
                                            <div class="dropdown dropleft">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cogs"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    @if ($key->status_id===7)
                                                        <a class="dropdown-item" href="{{ route('hr.staff.vacations.set.accepted',['id'=>$key->id]) }}">
                                                            <i class="far fa-check-circle text-success"></i> Aceptar
                                                        </a>
                                                        
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="{{ route('hr.staff.vacations.set.denied',['id'=>$key->id]) }}">
                                                            <i class="fas fa-ban text-danger"></i> Rechazado
                                                        </a>    
                                                    @endif

                                                    @if ($key->status_id===8)

                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="{{ route('hr.staff.vacations.set.cancel',['id'=>$key->id]) }}">
                                                            <i class="fas fa-trash text-danger"></i> Cancelar
                                                        </a>
                                                        
                                                    @endif
                                                    
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" target="_blank" href="{{ route('hr.staff.pdf.vacation',['id'=>$key->id]) }}">
                                                        <i class="fas fa-file-pdf"></i> Formato
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach                                
                            @endif
                        </tbody>
                    </table>                    
                    
                    <table class="table table-striped">
                        <tbody>
                           <tr>
                                <td><b>DIAS YA DISFRUTADOS EN EL AÑO</b></td>
                                <td><span>{{ $total_days }}</span></td>
                           </tr>
                           <tr>
                            <td><b>DIAS POR DISFRUTAR</b></td>
                            <td><span id="rest_days"></span></td>
                       </tr>
                        </tbody>
                    </table>
                </div>

               

            </div>

            
        </div>
    
    </div>

    @section('js')
        <script>
            const rest_days = document.getElementById('rest_days');
            let corresponds_days = parseInt({{ $corresponds_days }})
            let total_days = parseInt({{ $total_days }})
            rest_days.innerText = corresponds_days-total_days;

            if(corresponds_days-total_days<=0){

                let vacations_form = document.querySelectorAll('#vacations_form .form-control');
                vacations_form.forEach( el =>{                    
                    el.setAttribute('disabled', '');
                } )

                set_request_btn.setAttribute('disabled', '');
                document.getElementById('alert_container').innerHTML = `
                    <div class="alert alert-warning">
                        <h5>Vacaciones Agotadas</h5>
                    </div> 
                `;
            }

            $(function () {
                $('#start_date').datetimepicker({
                    format: 'YYYY-MM-DD' ,
                    icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    } 
                });

                $('#end_date').datetimepicker({
                    format: 'YYYY-MM-DD' ,
                    icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    } 
                });

                $('#come_back_date').datetimepicker({
                    format: 'YYYY-MM-DD' ,
                    icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    } 
                });
            });
        </script>
    @endsection

@stop
