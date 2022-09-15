@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ __('recruitment') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('census') }}</li>
            </ol>
        </nav>      
    @stop

    @section('content')

    @stop

@stop
