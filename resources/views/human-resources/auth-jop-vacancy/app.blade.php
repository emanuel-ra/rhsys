@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Recursos Humanos</li>
                <li class="breadcrumb-item " aria-current="page"><a href="{{ route('authorized.job.vacancies') }}">Autorizacion de vacantes</a></li>
            </ol>
        </nav>
    @stop
    
    <div class="card">
        <div class="card-header">
          <h3 class="card-title"></h3>
          <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-12">
                {{ $branches->links('pagination::bootstrap-4') }}
            </div>

            <table id="table_records" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Sucursal</th>     
                        <th>Configurar</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($branches as $branch )
                        <tr>
                            <td>{{ $branch->company->name }}</td>
                            <td>{{ $branch->name }}</td>
                            <td>
                                @can('authorized.job.vacancies.config')
                                    <a href="{{route('authorized.job.vacancies.config',['company_id'=>$branch->company_id,'branch_id'=>$branch->id])}}" class="btn btn-primary">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                @endcan                                
                            </td>
                        </tr>
                   @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Empresa</th>
                        <th>Sucursal</th>       
                        <th>Configurar</th>
                    </tr>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="col-12">
                {{ $branches->links('pagination::bootstrap-4') }}
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
