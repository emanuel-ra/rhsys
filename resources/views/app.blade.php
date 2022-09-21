@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.TempusDominusBs4', true)



@yield('body')

@section('css')
{{-- 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/keytable/2.7.0/css/keyTable.dataTables.min.css">
     --}}
@stop

@section('js')
{{--     
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/keytable/2.7.0/js/dataTables.keyTable.min.js"></script> --}}


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function () {
            /*
            $('#table_records').DataTable({
                responsive: true ,
                keys: true ,
            });
            */
            
        });
    </script>
@stop