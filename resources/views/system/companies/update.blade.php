@extends('app')

@section('content')

    @section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">            
            <li class="breadcrumb-item active" aria-current="page">Sistemas</li>
            <li class="breadcrumb-item active" aria-current="page">Registrar</li>
            <li class="breadcrumb-item"><a href="{{ route('system.companies.update') }}">Actualizar</a></li>
        </ol>
    </nav>
    @stop

    <x-dg-card title="Title" bg="primary" :full="false" :maximizable="true" :collapsed="false" :buttons="true">

    </x-dg-card>

@stop
