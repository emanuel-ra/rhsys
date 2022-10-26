@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sistemas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Empresas</li>
            </ol>
        </nav>
    @stop

    <div class="col-sm-12 p-2 d-flex justify-content-end">
        @can('companies.create')
            <a href="{{ route('system.companies.register') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>          
                Crear
            </a>
        @endcan        
        
    </div>

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Listado</h3>
          <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="table_records" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>Nombre Comercial</th>
                        <th>Razon Social</th>
                        <th>Direccion</th>
                        <th>Codigo postal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($companies as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>                                
                                @if ($item->image!='' && \File::exists(public_path().'/images/logo/'.$item->image))
                                    <img src="{{'/images/logo/'.$item->image}}" style="max-width: 100px;" alt="logo">
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->business_name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->zip_code }}</td>
                            <td>
                                <div class="dropdown dropleft show">
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuCompanies" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuCompanies">
                                        @can('companies.update')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('system.companies.edit',['id' => $item->id]) }}">
                                                    <i class="fa fa-pencil-alt"></i> Editar
                                                </a>
                                            </li>
                                        @endcan                                        

                                        @can('companies.upload.logo')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('system.companies.upload.logo',['id' => $item->id]) }}">
                                                    <i class="fas fa-cloud-upload-alt"></i> Logotipo
                                                </a>
                                            </li>
                                        @endcan   

                                    </div>
                                </div>
                            </td>                        
                        </tr>
                   @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>Nombre Comercial</th>
                        <th>Razon Social</th>
                        <th>Direccion</th>
                        <th>Codigo postal</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="col-12">
                {{ $companies->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <!-- /.card -->
      
    @section('js')
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }          
        </script>
    @endsection
@stop
