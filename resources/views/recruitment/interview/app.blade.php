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
                    headerToolbar: {
                        left  : 'prev,next today',
                        center: 'title',
                        right : 'dayGridMonth,timeGridWeek,timeGridDay'
                    },              
                    initialView: 'dayGridMonth' ,
                    timeZone: 'America/Mexico_City',
                    themeSystem: 'bootstrap' ,
                    eventSources: [
                        // your event source
                        {
                            url: '/ajax/get/events',
                            method: 'POST',
                            extraParams: {
                                _token: '{{ csrf_token() }}',
                            },
                            failure: function(error) {
                                //alert('there was an error while fetching events!');
                                console.log(error)
                            },
                            //color: 'yellow',   // a non-ajax option
                            //textColor: 'black' // a non-ajax option
                        }
                    ],
                        
                });
                calendar.setOption('locale', 'es');
                calendar.setOption('timeZoneParam', 'es');

               



                calendar.render();

                calendar.on('dateClick', function(info) {
                    console.log('clicked on ' + info.dateStr);
                });
                
            });
        </script>        
    @endsection
 
@stop
