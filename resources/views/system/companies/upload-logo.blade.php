@extends('app')

@section('content')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Sistemas</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('system.companies') }}">Empresas</a></li>
            <li class="breadcrumb-item"><a href="{{ route('system.companies.register') }}">Logotipo</a></li>
        </ol>
    </nav>
@stop

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Carga Logotipo</h3>
        <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                    class="fas fa-expand"></i></button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('system.companies.store') }}" method="POST">
            @csrf

            <div class="form-group">

                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 p-2 d-flex justify-content-between">

                <a href="{{ route('system.companies') }}" class="btn btn-default">
                    Cancelar
                </a>

                <button class="btn btn-primary">
                    Guardar
                </button>
            </div>

        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@stop
