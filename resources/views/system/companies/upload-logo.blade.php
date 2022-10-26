@extends('app')

@section('plugins.FileInput', true)

@section('content')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Sistemas</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('system.companies') }}">Empresas</a></li>
            <li class="breadcrumb-item"><a href="{{ route('system.companies.upload.logo',['id'=>$id]) }}">Logotipo</a></li>
        </ol>
    </nav>
@stop

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Carga Logotipo: <b>{{ $company->name }}</b></h3>
        <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                    class="fas fa-expand"></i></button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('system.companies.store.logo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="form-group">

                <input id="input-logo" type="file" class="file" name="image" data-preview-file-type="text">

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

                <a href="{{ route('system.companies') }}" class="btn btn-default">
                    Cancelar
                </a>

            </div>

        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@section('js')
    <script>
        $("#input-logo").fileinput({
            'language':'es' ,
            initialPreview: [
                "<img src='/images/logo/{{ $company->image }}' class='file-preview-image' alt='logo' title='logo'>"
            ],          
            initialPreviewShowDelete:false ,
            //allowedFileTypes:['jpeg','png','jpg','gif','svg']
        });

    </script>
@endsection
@stop
