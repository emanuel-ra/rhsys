@extends('app')

@section('plugins.fullcalendar', true)

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('recruitment.prospects') }}">Reclutamiento</a></li>
                <li class="breadcrumb-item active" aria-current="page">Prospectos</li>
            </ol>
        </nav>
    @stop

    <div class="col-sm-12 p-2 d-flex justify-content-end">

        <button class="btn btn-info mr-2" onclick="document.getElementById('form_filters').submit();">
            <i class="fa fa-search"></i>
        </button>    

        @can('users.create')
            <a href="{{ route('recruitment.prospects.form.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>          
                Nueva Prospecto
            </a>
        @endcan            
    </div>

 
    <div class="card  col-12">
        <div class="card-header">
          <h3 class="card-title">Calendario</h3>
          <div class="card-tools">
            <!-- Maximize Button -->
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id='calendar'></div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
           
        </div>
    </div>
    <!-- /.card -->
      
    @section('js')
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
                });
                calendar.render();
            });
        </script>        
    @endsection
 
@stop
