@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sistema</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perfil</li>
            </ol>
        </nav>
    @stop

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Cambio de Contraseña</h3>
          <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <form action="{{ route('system.profile.change.password.update') }}" method="post">
                @csrf
                <div class="form-group col-12 col-lg-6">
                    <label for="">Nueva contraseña</label>
                    <input type="password" class="form-control" name="password" value="" placeholder="Ingrese una nueva contraseña">
                </div>

                <div class="form-group col-12 col-lg-6">
                    <label for="">Confirmación de contraseña</label>
                    <input type="password" class="form-control" name="c_password" value="" placeholder="Repita la nueva contraseña">
                </div>

                <button class="btn btn-primary">
                    Guardar
                </button>

            </form>

            @if ($errors->any())
                <div class="col-12 alert alert-danger mt-2" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))
                <div class="col-12 alert alert-success text-center  mt-2">
                    <h1>{{session('success')}}</h1>
                </div>
            @endif


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
      
 
@stop
