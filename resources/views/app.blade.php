@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.TempusDominusBs4', true)


@yield('body')

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">
@stop

@section('js')

    <script src="{{ asset('public/js/app.js') }}"></script>
    {{--
    <script src="{{ asset('js/main.js') }}"></script>
    --}}

@stop
