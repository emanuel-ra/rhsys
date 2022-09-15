@extends('adminlte::page')

@section('title', 'Dashboard')


@yield('body')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
@stop

@section('js')

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table_recrods').DataTable();
        });
    </script>
@stop