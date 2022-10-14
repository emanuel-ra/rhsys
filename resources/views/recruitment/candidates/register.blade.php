@extends('app')

@section('plugins.imask', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Reclutamiento</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('recruitment.candidates') }}">Candidatos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitment.candidates.form.create') }}">Nuevo</a></li>
            </ol>
        </nav>
    @stop

    <div class="card card-tabs">
        <div class="card-header">
            <h3 class="card-title">Registro Nuevo</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>            
        </div>

        <div class="card-body  p-0">

           
            <form action="{{ route('recruitment.candidates.store') }}" method="POST">
                @csrf

                <div class="row p-2">
                    
                    <div class="col-sm-12">
                        <x-dg-input type="text" label="Nombre" name="name" maxlength="255" value="{{old('name')}}" placeholder=""  />
                    </div>
                    
                    
                    <div class="col-sm-12 col-lg-6">
                        <x-dg-input type="text" label="Email" id="email" name="email" maxlength="255" value="{{old('email')}}" placeholder=""  />
                    </div>
                    
                    <div class="col-sm-12 col-lg-6">
                        <x-dg-input type="text" label="Teléfono/Celular" id="mobile_phone" name="mobile_phone" maxlength="255" value="{{old('mobile_phone')}}" placeholder=""  />
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="sources_id">Fuente</label>
                        <select name="sources_id" id="sources_id" class="form-control" required >
                            <option value=""></option>
                            @foreach ($CandidateSource as $item)
                                <option {{ ($item->id==old('sources_id')) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-12 col-lg-6">
                        <label for="requisition_id">Requisicion</label>
                        <select name="requisition_id" id="requisition_id" class="form-control">
                            <option value=""></option>
                            @foreach ($Requisitions as $item)
                                <option {{ ($item->id==old('requisition_id')) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->branch->name }} / {{ $item->position->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-12">
                        <label for="">Comentarios</label>
                        <textarea class="form-control" maxlength="500" name="commentaries">{{old('commentaries')}}</textarea>
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

@stop


@section('js')
    <script>
        var element = document.getElementById('mobile_phone');
        var maskOptions = { mask: '(00) 0000-0000' };
        var mask = IMask(element, maskOptions);
        
    </script>
@endsection
