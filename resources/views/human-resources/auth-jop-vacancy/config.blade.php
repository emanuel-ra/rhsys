@extends('app')

@section('plugins.imask', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Recursos Humanos</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('authorized.job.vacancies') }}">Autorizacion de vacantes</a></li>
                <li class="breadcrumb-item"><a href="{{ route('authorized.job.vacancies.config',['company_id'=>$branch->company_id,'branch_id'=>$branch->id]) }}">Configurar</a></li>
            </ol>
        </nav>
    @stop

    <div class="card card-tabs">
        <div class="card-header">
            <h3 class="card-title">{{ $branch->company->name }} / {{ $branch->name }} </h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>            
        </div>

        <div class="card-body  p-0">

            <form action="{{ route('authorized.job.vacancies.config.post') }}" method="POST">
                <input type="hidden" name="company_id" value="{{ $company_id }}">
                <input type="hidden" name="branch_id" value="{{ $branch_id }}">
                @csrf

                <div class="row p-2">
                    
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Puesto</th>
                                    <th>Cantidad Autorizada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($JopPosition as $position)
                                    <tr>
                                        <td>{{ $position->name }}</td>
                                        <td>
                                            <input type="text" class="form-control" id="jp_{{$position->id}}" value="0"  name="jop_position[{{$position->id}}]" placeholder="Cantidad">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                    
                <div class="col-sm-12 p-2 d-flex justify-content-between">
                    
                    <a href="{{ route('hr.staff') }}" class="btn btn-default">
                        Cancelar
                    </a>

                    <button class="btn btn-primary">
                        Guardar
                    </button>
                </div>
    
            </form>

            
        </div>
    
    </div>


    @section('js')
    <script >
        let data = {!! json_encode($authorizedpost) !!}
        data.map( (e) => {          
            let ele = document.getElementById(`jp_${e.jop_position_id}`).value = e.quantity          
        })
    </script>        
    @endsection        
@stop
