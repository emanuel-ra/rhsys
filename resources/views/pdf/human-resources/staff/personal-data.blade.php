<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos Personales</title>
</head>
<body>

    <style>
        *{
            font-family: Arial, Helvetica, sans-serif; 
        }
        header{
            width: 100%;
        }
        header table{ width: 100%; }
        h1{ font-size: 18pt; }
        .data{ font-size: 10pt; }        
        .p-10{ padding: 10px;}
        .text-center{ text-align: center }
        .text-right{ text-align: right }
    </style>

   
    <header>
        <table>
            <tr>
                <td align="center" style="width: 100px;height: 100px;padding:0px;">
                    @if ($Company->image!='' && \File::exists('./images/logo/'.$Company->image))
                        <img src="{{'./images/logo/'.$Company->image}}" style="width: 100px;height: 100px;" alt="logo">
                    @endif                 
                </td>
                <td style="border: 1px solid #000; text-align:center;width: 300px;"><h1 class="bg-danger">DATOS PERSONALES</h1></td>
                <td style="font-size: 8pt;border:1px dashed #000; padding:0;width: 145px;">
                    <table>
                        <tr>
                            <td style="border-bottom: 1px dashed #000;border-right:1px dashed #000;">CÓDIGO</td>
                            <td style="border-bottom: 1px dashed #000;text-align:center">F-RH-{{$data->id}}</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px dashed #000;border-right:1px dashed #000;">VERSION</td>
                            <td style="border-bottom: 1px dashed #000;text-align:center">1</td>
                        </tr>
                        <tr>
                            <td style="border-right:1px dashed #000;">EMISIÓN</td>
                            <td style="text-align:center">{{ \Carbon\Carbon::now()->format('d M Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        {{-- <img src="{{url('/images//logo'.$Company->image)}}" alt=""> --}}
    </header>
    

    <section class="data">
        <table style="width: 100%;" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width: 130px;">NOMBRE COMPLETO</td>
                <td class="p-10" style="border: 1px solid #000;text-align:center" colspan="5"><b>{{$data->name}}</b></td>
            </tr>
            <tr><td colspan="6" style="height: 5px;"></td></tr>
            <tr>
                <td>FECHA DE <br> NACIMIENTO</td>
                <td class="p-10" colspan="1" style="border: 1px solid #000; text-align:center">
                    {{ \Carbon\Carbon::create($data->born_date)->format('d/m/Y')}}
                    <br>
                    <small style="color: gray;font-size:7.5pt">DD MM AAAA</small>
                </td>
                <td class="text-center">LUGAR DE <br> NACIMINETO</td>
                <td class="p-10" colspan="3" style="border: 1px solid #000">{{$data->born_place}}</td>
            </tr>

            <tr><td colspan="6" style="height: 5px;"></td></tr>

            <tr>
                <td>RFC</td>
                <td class="p-10" style="border: 1px solid #000">{{$data->rfc}}</td>
                <td class="text-center">C.U.R.P</td>
                <td class="p-10" colspan="3" style="border: 1px solid #000">{{$data->curp}}</td>
            </tr>
            
            <tr><td colspan="6" style="height: 5px;"></td></tr>

            <tr>
                <td>NÚMERO DE SS</td>
                <td class="p-10" style="border: 1px solid #000">{{$data->nss}}</td>
                <td class="text-center">ESTADO CIVIL</td>
                <td class="p-10" colspan="3" style="border: 1px solid #000">{{$data->maritalstatus->name}}</td>
            </tr>

            <tr><td colspan="6" style="height: 5px;"></td></tr>

            <tr>               
                <td>NACIONALIDAD</td>
                <td class="p-10" style="border: 1px solid #000">{{$data->country->nationality}}</td>
                <td class="text-center">SEXO</td>
                <td class="p-10" style="border: 1px solid #000">{{$data->genre}}</td>
                <td class="text-center">TIPO DE <br> SANGRE</td>
                <td class="p-10" style="border: 1px solid #000">{{$data->blood_type}}</td>
            </tr>
            <tr><td colspan="6" style="height: 5px;"></td></tr>
            <tr>
                <td>NOMBRE DEL PADRE</td>
                <td class="p-10" style="border: 1px solid #000;text-align:center" colspan="5"><b>{{$data->father_name}}</b></td>
            </tr>
            <tr><td colspan="6" style="height: 5px;"></td></tr>
            <tr>
                <td>NOMBRE DE LA MADRE</td>
                <td class="p-10" style="border: 1px solid #000;text-align:center" colspan="5"><b>{{$data->mother_name}}</b></td>
            </tr>
            <tr><td colspan="6" style="height: 5px;"></td></tr>
            <tr>
                <td>NOMBRE DE CÓNYUGE</td>
                <td class="p-10" style="border: 1px solid #000;text-align:center" colspan="5"><b>{{$data->spouse_name}}</b></td>
            </tr>
            <tr><td colspan="6" style="height: 5px;"></td></tr>
            
            <tr>
                <td>NOMBRE DE LOS HIJOS</td>
                <td class="p-10" style="border: 1px solid #000;text-align:center" colspan="5"><b>{{$data->chields_name}}</b></td>
            </tr>

            <tr><td colspan="6" style="height: 20px;border-bottom:1px solid #000;"></td></tr>
            <tr><td colspan="6" style="height: 20px;"></td></tr>

            <tr>
                <td>DOMICILIO CALLE Y NO.</td>
                <td class="p-10" colspan="2" style="border: 1px solid #000;width:150px;">{{ $data->address }}</td>
                <td class="text-center">COLONIA</td>
                <td class="p-10" colspan="2" style="border: 1px solid #000">{{$data->suburb}}</td>
            </tr>

            <tr>
                <td>MUNICIPIO</td>
                <td class="p-10" colspan="2" style="border: 1px solid #000">{{$data->town}}</td>
                <td class="text-center">ESTADO</td>
                <td class="p-10" colspan="2" style="border: 1px solid #000">{{$data->state->name}}</td>
            </tr>

            <tr>
                <td>CODIGO POSTAL</td>
                <td class="p-10" colspan="2" style="border: 1px solid #000">{{$data->zip_code}}</td>
                <td class="text-center">E-MAIL</td>
                <td class="p-10" colspan="2" style="border: 1px solid #000">{{$data->email}}</td>
            </tr>

            <tr>
                <td>TEL. CELULAR</td>
                <td class="p-10" colspan="2" style="border: 1px solid #000">{{$data->mobile_phone}}</td>
                <td class="text-center">TEL. FIJO O <br> REACADOS</td>
                <td class="p-10" colspan="2" style="border: 1px solid #000">{{$data->landline_number}}</td>
            </tr>


            <tr><td colspan="6" style="height: 20px;border-bottom:1px solid #000;"></td></tr>
            <tr><td colspan="6" style="height: 20px;"></td></tr>

            <tr>
                <td>EN CASO DE EMERGENCIA, <br> LLAMAR A; </td>
                <td class="p-10" style="border: 1px solid #000;text-align:center" colspan="5">
                    <b>{{$data->name_person_emergency}}</b>
                </td>
            </tr>
            
            <tr><td colspan="6" style="height: 5px;"></td></tr>

            <tr>
                <td>TEL. CELULAR</td>
                <td class="p-10" style="border: 1px solid #000">{{$data->mobile_emergency_phone}}</td>
                <td class="text-center" colspan="2">TEL. FIJO O <br> REACADOS</td>
                <td class="p-10" colspan="2" style="border: 1px solid #000">{{$data->landline_emergency_phone}}</td>
            </tr>

            <tr><td colspan="6" style="height: 20px;border-bottom:1px solid #000;"></td></tr>
            <tr><td colspan="6" style="height: 20px;"></td></tr>

            <tr>
                <td colspan="2" class="text-center">RATIFICO QUE LOS DATOS AQUÍ ESCRITOS SON VERDADEROS</td>
                <td colspan="2"></td>
                <td colspan="2" class="text-center">RECURSOS HUMANOS</td>
            </tr>

            <tr>
                <td colspan="2" style="border-bottom: 1px solid #000;height: 70px;margin-right:3px;"></td>
                <td colspan="2"></td>
                <td colspan="2" style="border-bottom: 1px solid #000;height: 70px;margin-right:3px;"></td>
            </tr>

            <tr>
                <td colspan="2" class="text-center" style="">NOMBRE Y FIRMA</td>
                <td colspan="2"></td>
                <td colspan="2" class="text-center" style="">NOMBRE Y FIRMA</td>
            </tr>

        </table>

    </section>
    
</body>
</html>