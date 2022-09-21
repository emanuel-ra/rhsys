@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">            
                <li class="breadcrumb-item active" aria-current="page">Sistemas</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('system.users') }}">Usuario</a></li>
                <li class="breadcrumb-item"><a href="{{ route('system.users.edit',['id'=>$id]) }}">Actualizar</a></li>
            </ol>
        </nav>
    @stop

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Actualizar</h3>
          <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('system.users.update',['id'=>$id]) }}" method="POST">
                @csrf

                <div class="col-sm-12">
                    <x-dg-input type="text" label="Nombre de Usuario" name="name" maxlength="255" value="{{ $user->name }}" placeholder="Capture el nombre del usuario" required />
                </div>

                <div class="col-sm-12">
                    <x-dg-input type="email" label="Nombre del email" name="email" maxlength="255" value="{{ $user->email }}" placeholder="Capture el email del usuario" required />
                </div>


                <div class="col-sm-12">
                    <x-dg-input type="password" label="Nombre su contraseña" name="password" maxlength="255" placeholder="Capture una contraseña valida contraseña" />
                </div>


                <div class="col-sm-12">
                    <x-dg-input type="password" label="Confirme su contraseña" name="cpassword" maxlength="255" placeholder="Confirme su contraseña" />
                </div>
                
                <div class="col-sm-12">
                    <x-dg-select id="role_id" name="role_id" label="Rol" required>
                        <x-dg-option value=""></x-dg-option>
                        @foreach ($Role as $item)                            
                            <x-dg-option selected="{{ ($user->roles[0]->id==$item->id) ? true:false }}"  value="{{ $item->id }}">{{ $item->name }}</x-dg-option>
                        @endforeach
                    </x-dg-select>
                </div>
                
                <div class="row">
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
                    
                    <a href="{{ route('system.users') }}" class="btn btn-default">
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
