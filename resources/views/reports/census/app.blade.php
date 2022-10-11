@extends('app')

@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Reportes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Censo</li>
            </ol>
        </nav>      
    @stop

    @section('content')
        <div class="row">
            <div class="card col-12">
                <div class="card-header">
                    <h4>Censo</h4>
                    <div class="card-tools">
                        <!-- Maximize Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                                <tr>
                                    <th rowspan="2" class="text-center">Puestos</th>   
                                    @foreach ($data[0]["authorized"] as $item)
                                        <th colspan="3" class="text-center">{{ $item["branch_name"] }}</th>
                                    @endforeach               
                                </tr>
                                <tr>
                                    @foreach ($data[0]["authorized"] as $item)
                                        <td>Autorizado</td>
                                        <td>Plantilla Actual</td>
                                        <td>Vacantes</td>
                                    @endforeach   
                                </tr>
                        </thead>
                        <tbody>
                                @foreach ($data as $key)
                                    <tr>
                                        <td>{{ $key["puesto"] }}</td>                               
                                        @foreach ($key["authorized"] as $item)
                                            @php
                                                $v = $item["authorized"]-$item["staff_quantity"];
                                            @endphp
                                            <td class="text-center">{{ $item["authorized"] }}</td>
                                            <td class="text-center">{{ $item["staff_quantity"] }}</td>
                                            <td class="text-center">{{ $v }}</td>
                                        @endforeach      
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    @stop

@stop
