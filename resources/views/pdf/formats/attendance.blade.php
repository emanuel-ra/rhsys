<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control de Asistencias</title>
</head>
<body>

    <style>
        
        @page { margin: 0.5cm 2.2cm; size: 21.6cm 34.0cm landscape; }
        .page-break { page-break-after: always; }        
        *{ font-family: Arial, Helvetica, sans-serif; }
        .wrapper{ width: 100%; height: 100%; }
        footer {       
            position: fixed; 
            bottom: 10px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            width: 100%;
            /** Extra personal styles **/
            text-align: center;
        }
    </style>

    <footer>
        <table>
            <tr>
                <td style="width:50px"></td>
                <td style="border-top: 1px solid #000000;width:300px;padding:0;text-align: center;">FIRMA RH</td>
                <td style="width:300px"></td>
                <td style="border-top: 1px solid #000000;width:300px;padding:0;text-align: center;">FIRMA RESPONSABLE AREA</td>
                <td style="width:50px"></td>
            </tr>
        </table>
    </footer>

    
    <div class="wrapper">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="{{(count($period)*2)+1}}" style="text-align: center;">{{ $company->name }}</td>
            </tr>
            <tr>
                <td colspan="5" style="background: #212121;color:white;text-align: center;">
                    <b>{{ $title }}</b>
                </td>
                <td colspan="5" style="text-align: center;border:1px solid #000000;">
                    <b>Del {{ Carbon\Carbon::parse($start_date)->format('d') }} Al {{ Carbon\Carbon::parse($end_date)->formatLocalized('%d de %B %Y') }}</b>
                </td>
                <td colspan="{{ (count($period)*2)-9 }}" style="text-align: center;border:1px solid #000000;">
                    Reconozco y acepto que lo que se plasmó en esta lista, fueron mis incidencias de la quincena.                   
                </td>
            </tr>
            <tr style="font-size: 10.5px;">
                <td style="background: #212121;color:white;text-align: center;">NOMBRE</td>
                @if (count($period))
                    @foreach ($period as $item)
                        <td style="text-align: center;background: #212121;color:white;">
                            {{ ucfirst(Carbon\Carbon::parse($item)->isoFormat('dddd')); }} <br>
                            {{ Carbon\Carbon::parse($item)->format('d-m-Y'); }}
                        </td>
                        <td style="text-align: center;background: #212121;color:white;">Horario</td>
                    @endforeach
                @endif
            </tr>
            @foreach ($staff as $item)
                <tr>
                    <td style="border: 1px solid #000000;padding:1px;margin:0;width: 200px;padding-left:5px;">{{ $item->name }}</td>
                    @foreach ($period as $item)
                        <td style="border: 1px solid #000000;width: 60px;">

                        </td>
                        <td style="border: 1px solid #000000;padding:0;width: 60px;">
                            <table style="width: 100%;padding:0;margin:0;">
                                <tr><td style="border-bottom:1px solid #000000;height:11px;margin:0;padding:0;"></td></tr>
                                <tr><td style="border-bottom:1px solid #000000;height:11px;margin:0;padding:0;"></td></tr>
                                <tr><td style="border-bottom:1px solid #000000;height:11px;margin:0;padding:0;"></td></tr>
                                <tr><td style="height:11px;margin:0;padding:0;"></td></tr>
                            </table>
                        </td>
                    @endforeach
                    
                    @if ($rows>=9)
                        </table>
                        <div class="page-break"></div>
                        <table cellspacing="0" cellpadding="0">                            
                            <tr>
                                <td colspan="{{(count($period)*2)+1}}" style="text-align: center;">{{ $company->name }}</td>
                            </tr>
                            <tr>              
                                <td colspan="5" style="background: #212121;color:white;text-align: center;">
                                    <b>{{ $title }}</b>
                                </td>                  
                                <td colspan="5" style="text-align: center;border:1px solid #000000;">
                                    <b>Del {{ Carbon\Carbon::parse($start_date)->format('d') }} Al {{ Carbon\Carbon::parse($end_date)->formatLocalized('%d de %B %Y') }}</b>
                                </td>
                                <td colspan="{{ (count($period)*2)-9 }}" style="text-align: center;border:1px solid #000000;">
                                    Reconozco y acepto que lo que se plasmó en esta lista, fueron mis incidencias de la quincena.                   
                                </td>
                            </tr>
                            <tr style="font-size: 10.5px;">
                                <td style="background: #212121;color:white;text-align: center;">NOMBRE</td>
                                @if (count($period))
                                    @foreach ($period as $item)
                                        <td style="text-align: center;background: #212121;color:white;">
                                            {{ ucfirst(Carbon\Carbon::parse($item)->isoFormat('dddd')); }} <br>
                                            {{ Carbon\Carbon::parse($item)->format('d-m-Y'); }}
                                        </td>
                                        <td style="text-align: center;background: #212121;color:white;">Horario</td>
                                    @endforeach
                                @endif
                            </tr>
                    @endif
                    @php
                        if($rows>=9){ $rows=0; }
                        $rows++;
                    @endphp
                </tr>
                
            @endforeach    


        </table>
    </div>
    
</body>
</html>