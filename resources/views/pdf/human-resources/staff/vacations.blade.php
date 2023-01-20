<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud de Vacaciones</title>
</head>
<body>

    <style>
        .header{ width: 700px; }
        .header table{ width: 700px; }
        .header table th{ border: 1px solid #000000; }
        .staff-container{ width: 700px; margin-top: 50px; }
        .company-container{ width: 700px; margin-top: 20px; }
        .vacation-container{ width: 700px; margin-top: 20px; }
        .bg-info{ background: #f2f2f2; }
    </style>
    
    <div class="header">
        <table>
            <thead>
                <tr>
                    <th  style="width: 130px;"></th>
                    <th>
                        SOLICITUD DE VACACIONES
                    </th>
                    <th style="width: 200px;">
                        <table style="width: 200px;">
                            <tr>
                                <td>Código</td>
                                <td>{{ env('HR_DOCUMENT_REQUEST_VACATIONS_CODE') }}</td>
                            </tr>
                            <tr>
                                <td>Version</td>
                                <td>{{ env('HR_DOCUMENT_REQUEST_VACATIONS_VERSION') }}</td>
                            </tr>
                            <tr>
                                <td>Emisión</td>
                                <td>{{ \Carbon\Carbon::now()->format('Y-m-d'); }}</td>
                            </tr>
                        </table>
                    </th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="staff-container">
        <table>
            <tr>
                <td style="width: 500px;text-align:center;"><b>NOMBRE DEL TRABAJADOR</b></td>
                <td style="width: 200px;text-align:center;"><b>NO. EMPLEADO</b></td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #000000;">{{ $data->staff->name }}</td>
                <td style="border-bottom: 1px solid #000000;text-align:center;">{{ $data->staff->code }}</td>
            </tr>                
            <tr>
                <td colspan="2"><b>Empresa</b> {{ $data->staff->company->name }}</td>
            </tr>
            <tr>
                <td style="width: 500px;text-align:left;"><b>PUESTO DEL TRABAJADOR</b></td>
                <td style="width: 200px;text-align:center;"><b>FECHA DE INGRESO</b></td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #000000;">{{ $data->staff->position->name }}</td>
                <td style="border-bottom: 1px solid #000000;text-align:center;">{{ $data->staff->hired_date }}</td>
            </tr>  
        </table>
    </div>

    <div class="vacation-container">
        <table style="width: 700px;">
            <tr>
                <td style="width: 190px;font-size:13px;border-right:1px solid #000000; " valign="top">
                    <table class="">
                        <thead>
                            <tr>
                                <th style="text-align:left;"> {{ ucfirst(__('words.years of work')) }}</th>
                                <th style="text-align:right;"> {{ ucfirst(__('words.days of vacations')) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($vacations_table))
                                @foreach($vacations_table as $key)                                    
                                    @php
                                        $corresponds = '';
                                        if($key->from === $key->to && $antiquity===$key->to && ($available_vacations)){
                                            $corresponds = 'bg-info';
                                        }                                           
                                        if($key->from !== $key->to && $antiquity>=$key->from && $antiquity<=$key->to && ($available_vacations)){
                                            $corresponds = 'bg-info';
                                        }                                            
                                    @endphp
                                    <tr class="{{ $corresponds }}">
                                        <td>
                                            {{ ucfirst(__('vacations-table.'.$key->label)) }}
                                        </td>
                                        <td style="text-align:right;">
                                            {{ $key->days }} {{ __('words.days') }}
                                        </td>                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </td>

                <td style="width: 400px;font-size:13px;" valign="top">
                    <table>
                        <tr>
                            <td style="width: 400px;"><b>FECHA DE ELABORACIÓN</b> </td>
                            <td style="border: 1px solid #000000;width: 100px;padding:2px;text-align:center;">{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <td> <b>DÍAS PROP. CORRESPONDIENTES</b> </td>
                            <td style="border: 1px solid #000000;width: 100px;padding:2px;text-align:center;">{{ $corresponds_days }}</td>
                        </tr>
                        <tr>
                            <td> <b>DÍAS YA DISFRUTADOS EN EL AÑO</b> </td>
                            <td style="border: 1px solid #000000;width: 100px;padding:2px;text-align:center;">{{ $number_days_used }}</td>
                        </tr>
                        <tr>
                            <td> <b>DÍAS SOLICITADOS</b> </td>
                            <td style="border: 1px solid #000000;width: 100px;padding:2px;text-align:center;">{{ $data->number_of_requested_days }}</td>
                        </tr>
                        <tr>
                            <td> <b>DÍAS POR DISFRUTAR</b> </td>
                            <td style="border: 1px solid #000000;width: 100px;padding:2px;text-align:center;">  
                                {{ $corresponds_days-$number_days_used }}
                            </td>
                        </tr>
                        <tr>
                            <td> <b>FECHA DE ENTREGA A RH</b> </td>
                            <td style="border: 1px solid #000000;width: 100px;padding:2px;text-align:center;"></td>
                        </tr>
                    </table>
                </td>                
            </tr>
            <tr>
                <td colspan="2">
                    <table style="width: 700px;">
                        <tr>
                            <td style="width: 200px;background:#b2b2b2;text-align:center;padding:5px;border:solid 1px #00000;">INICIO</td>
                            <td style="width: 200px;background:#b2b2b2;text-align:center;padding:5px;border:solid 1px #00000;">TERMINO</td>
                            <td style="width: 200px;background:#b2b2b2;text-align:center;padding:5px;border:solid 1px #00000;">DEBERA PRESENTARSE</td>
                        </tr>
                        <tr>
                            <td style="border:solid 1px #00000;padding:5px;text-align:center;">{{ $data->start_date }}</td>
                            <td style="border:solid 1px #00000;padding:5px;text-align:center;">{{ $data->end_date }}</td>
                            <td style="border:solid 1px #00000;padding:5px;text-align:center;">{{ $data->come_back_date }}</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table style="width: 700px;">
                        <tr>
                            <td style="width: 200px;background:#b2b2b2;text-align:center;padding:5px;border:solid 1px #00000;">
                                PAGO DE VACACIONES
                            </td>
                            <td style="width: 200px;background:#b2b2b2;text-align:center;padding:5px;border:solid 1px #00000;">
                                PRIMA VACACIONAL
                            </td>
                            <td style="width: 200px;background:#b2b2b2;text-align:center;padding:5px;border:solid 1px #00000;">
                                TOTAL A PAGAR
                            </td>
                        </tr>
                        <tr>
                            <td style="border:solid 1px #00000;padding:5px;text-align:center;"> &nbsp;</td>
                            <td style="border:solid 1px #00000;padding:5px;text-align:center;"> &nbsp;</td>
                            <td style="border:solid 1px #00000;padding:5px;text-align:center;"> &nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div style="width: 700px;height:60px;border-bottom:1px solid #000000;margin-top:5px;">
        <span>Observaciones RH:</span>
    </div>

    <div style="width: 700px;margin-top:30px;">
        <table>
            <tr>
                <td style="border-bottom: 1px solid #000000;width: 250px;">&nbsp;</td>
                <td style="width: 190px;"></td>
                <td style="border-bottom: 1px solid #000000;width: 250px;">&nbsp;</td>
            </tr>
            <tr>
                <td> <b>AUTORIZA, JEFE INMEDIATO</b> </td>
                <td></td>
                <td> <b>VO. BO. RECURSOS HUMANOS</b> </td>
            </tr>
            <tr>
                <td colspan="3" style="height: 15px;"></td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #000000;width: 250px;">&nbsp;</td>
                <td style="width: 190px;"></td>
                <td style="border-bottom: 1px solid #000000;width: 250px;">&nbsp;</td>
            </tr>
            <tr>
                <td> <b>NOMBRE Y FIRMA</b> </td>
                <td></td>
                <td> <b>NOMBRE Y FIRMA</b> </td>
            </tr>

            <tr>
                <td style="width: 250px;">&nbsp;</td>
                <td style="width: 190px;border-bottom: 1px solid #000000;"></td>
                <td style="width: 250px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" style="height:15px;"></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;"><b>FIRMA DEL TRABAJADOR</b></td>
                <td></td>
            </tr>

        </table>
    </div>

</body>
</html>