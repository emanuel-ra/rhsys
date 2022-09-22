@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.TempusDominusBs4', true)



@yield('body')

@section('css')

@stop

@section('js')

    <script src="{{ asset('js/app.js') }}"></script>
    {{-- 
    <script src="{{ asset('js/main.js') }}"></script> 
    --}}

    <script>
        $(document).ready(function () {
          
        });
    </script>
@stop