@extends('app')

@section('plugins.imask', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Reclutamiento</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('recruitment.interview.appointment') }}">Entevistas</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitment.interview.form.create') }}">Nuevo</a></li>
            </ol>
        </nav>
    @stop

    <div class="card card-tabs">
        <div class="card-header">
            <h3 class="card-title">Agendar Entrevista</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>            
        </div>

        <div class="card-body  p-0">

            <div class="col-12">
                <button class="btn btn-primary" onclick="$('#login_modal').modal('show')">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
            <form action="{{ route('recruitment.prospects.store') }}" method="POST">
                @csrf

                <div class="row p-2">
                    
                    <div class="col-sm-12">
                        <x-dg-input type="text" label="Nombre" name="name" maxlength="255" value="{{old('name')}}" placeholder=""  />
                    </div>

                    <div style="overflow:hidden;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="datetimepicker13"></div>
                                </div>
                            </div>
                        </div>
                        
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
                    
                    <a href="{{ route('recruitment.requisitions') }}" class="btn btn-default">
                        Cancelar
                    </a>

                    <button class="btn btn-primary">
                        Guardar
                    </button>
                </div>
    
            </form>

            
        </div>
    
    </div>

    <x-dg-modal id="login_modal" title="Modal Title">
        ...
    </x-dg-modal>

@stop


@section('js')
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker13').datetimepicker({
                inline: true,
                sideBySide: true
            });
        });
    </script>
@endsection
