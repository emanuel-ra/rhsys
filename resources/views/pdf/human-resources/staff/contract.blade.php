<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>

    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 11.5pt;
        }
        html{
            margin: 2.5cm 3cm 2.5cm 3cm;
        }
        .declarations{
            list-style-type: upper-roman;
            text-align: justify;  
            padding: 3%;        
        }
        .sub_declarations{
            list-style-type: decimal;
            padding: 0%;
        }
        .generals{
            list-style-type: lower-latin;           
            padding: 3%; 
        }
        .signature{
            width: 100%;           
        }
        .text-danger{ color: red;}
    </style>
</head>
<body>

    @if ($Company->business_name=='')
        <div style="width: 100%;text-align:center;padding:5px;border: 1px solid red;border-radius:5px;">
            <h1 class="text-danger">Falta configurar razon social de la empresa</h1>
        </div>
    @endif

    @if ($Company->legal_representative=='')
        <div style="width: 100%;text-align:center;padding:5px;border: 1px solid red;border-radius:5px;">
            <h1 class="text-danger">Falta configurar nombre del representate legal</h1>
        </div>
    @endif

    @if ($Company->address=='')
        <div style="width: 100%;text-align:center;padding:5px;border: 1px solid red;border-radius:5px;">
            <h1 class="text-danger">Falta configurar la direccion de la empresa</h1>
        </div>
    @endif

    @if ($Company->rfc=='')
        <div style="width: 100%;text-align:center;padding:5px;border: 1px solid red;border-radius:5px;">
            <h1 class="text-danger">Falta configurar el RFC de la empresa</h1>
        </div>
    @endif

    @if ($Company->public_deed=='')
        <div style="width: 100%;text-align:center;padding:5px;border: 1px solid red;border-radius:5px;">
            <h1 class="text-danger">Falta configurar la escritura pública de la empresa</h1>
        </div>
    @endif

    <div style="text-align: justify;">
        CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO DETERMINADO QUE SE CELEBRA CONFORME A LO ESTABLECIDO EN EL ARTÍCULO 25 Y 37 FRACCIÓN I DE LA LEY FEDERAL DEL TRABAJO VIGENTE, POR UNA PARTE, CON EL CARÁCTER DE PATRÓN, LA SOCIEDAD <b>{{strtoupper($Company->business_name)}}</b> A TRAVES DE SU REPRESENTANTE LEGAL EL C. <b>{{strtoupper($Company->legal_representative)}}</b>, Y POR LA OTRA COMO TRABAJADOR EL/LA C. <b>{{strtoupper($data->name)}}</b>, CONFORME A LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:
    </div>

    <p style="text-align: center;">DECLARACIONES:</p>

    <ol class="declarations">
        <li>
            DECLARA “EL PATRÓN”, A TRAVÉS DE SU REPRESENTANTE LEGAL:
            <ol class="sub_declarations">
                <li>EL C. <b>{{strtoupper($Company->legal_representative)}}</b>, declara que su apoderada <b>{{strtoupper($Company->business_name)}}</b> es una sociedad mercantil legalmente constituida conforme a las leyes mexicanas tal y como lo acredita con el testimonio de la escritura pública número {{($Company->public_deed)}}</li>

                <li>Declara <b>{{strtoupper($Company->business_name)}}</b> Que tiene su domicilio en {{($Company->address)}}. La cual cuenta con el siguiente Registro Federal de Contribuyentes: {{strtoupper($Company->rfc)}}</li>
            </ol>
        </li>
        <li>
            DECLARA “EL TGRABAJADOR”, POR SU PROPIO DERECHO Y BAJO PROTESTA DE DECIR VERDAD:
            <ol class="sub_declarations">
                <li>
                    El trabajador declara llamarse <b>{{strtoupper($data->name)}}</b> y bajo protesta de decir verdad declara tener la capacidad legal, experiencia y los conocimientos necesarios para desempeñar el puesto estipulado en este contrato, para los efectos legales a que haya lugar. 
                </li>
            </ol>
            <br>
            <span>El trabajador manifiesta tener los siguientes generales: </span>
            <ol class="generals">
                <li>Llamarse como se manifiesta en el encabezado del presente contrato. </li>
                <li>Ser de nacionalidad <b>{{($data->country->nationality)}}</b>. </li>
                <li>Tener  <b>{{  \Carbon\Carbon::parse($data->born_date)->age }}</b> años de edad. </li>
                <li>Ser de sexo <b>{{($data->genre)}}</b>. </li>
                <li>Estado civil: <b>{{($data->maritalstatus->name)}}</b>.  </li>
                <li>Clave única de registro de población (CURP): <b>{{strtoupper($data->curp)}}</b>.</li>
                <li>Registro federal de contribuyentes (RFC): <b>{{strtoupper($data->rfc)}}</b>.</li>
                <li>Número de seguridad social: <b>{{($data->nss)}}</b>.</li>
                <li>Correo electrónico: <b>{{($data->email)}}</b>. </li>
                <li>Tener su domicilio particular en: <b>{{($data->address)}}</b>. </li>
            </ol>
        </li>
        <li>
            DECLARAN “LAS PARTES”
            <ol class="sub_declarations">
                <li>
                    Declara <b>{{strtoupper($Company->business_name)}}</b> que requiere contratar los servicios de <b>{{strtoupper($data->name)}}</b> en los términos y condiciones que se precisan en este instrumento. <br> <br>
                    En el presente contrato, se denominará en lo sucesivo a la empresa <b>{{strtoupper($Company->business_name)}}</b>. como “EL PATRON” y al C. <b>{{strtoupper($data->name)}}</b> como “EL TRABAJADOR”; a la Ley Federal del Trabajo en lo sucesivo como “LA LEY”, al referirse al presente documento como “EL CONTRATO”, y a los que lo suscriben como “LAS PARTES”. <br> <br>
                    Estipuladas las anteriores declaraciones, las partes celebran el presente contrato bajo las siguientes
                </li>
            </ol>
        </li>
    </ol>

    <p style="text-align: center;">CLAUSULAS:</p>

    <p>
        PRIMERA.-  “EL TRABAJADOR” se obliga a desempeñar el trabajo personal subordinado para “EL PATRON”, en el puesto de <b>{{ $data->position->name }}</b> con las siguientes actividades: <b>{{$data->activities}}</b>.
    </p>

    <p>
        SEGUNDA.- “EL TRABAJADOR” se desempeñará en el puesto de PUESTO  y actividades relacionadas, con el puesto, y en lugar donde “EL PATRON” efectué sus actividades en su domicilio en el área metropolitana de la ciudad de Guadalajara. Pudiendo “EL TRABAJADOR”, desempeñar sus labores en cualquiera de las ciudades en que “EL PATRON” cuente con sucursales o proyectos. 
    </p>
    
    <p>
        TERCERA.- El presente contrato tendrá la duración de un periodo que se contara a partir de la firma del presente contrato, es decir, del <b>{{ \Carbon\Carbon::parse($data->hired_date)->formatLocalized('%d de %B %Y') }}</b> Y <b>{{ ($data->hired_date=='') ? 'Indeterminado' : \Carbon\Carbon::parse($data->expiration_date)->formatLocalized('%d de %B %Y')  }}</b>; en virtud de así exigirlo la naturaleza del trabajo que se desempeñara, señalado en la cláusula anterior, o bien cuando se termine la actividad objeto del presente contrato, lo que acontezca primero. Al termino establecido, concluirá la relación de trabajo, sin responsabilidad del patrón. 
    </p>

    <p>
        CUARTA.- “EL PATRON” de conformidad con el artículo 82 de la Ley Federal Del Trabajo cubrirá por los servicios contratados un salario por cuota diaria equivalente a $<b>{{number_format($data->daily_salary,2)}}</b> ({{number_to_letters(number_format($data->daily_salary,2),'MXN')}}), en el cual queda incluida la parte proporcional correspondiente al día de descanso semanal.          
    </p>
    <p>
        Dicha retribución se pagará los días 15 y 30 de cada mes, según corresponda en día laborable y en caso de que dichos días cayeran en un día inhábil, el pago se hará un día anterior hábil.         
    </p>
    <p>
        “EL TRABAJADOR” manifiesta que es su deseo que el pago le sea depositado mediante transferencia electrónica, en la cuenta bancaria que el mismo proporcionara para ello, por separado de este contrato. Así también se compromete a proporcionar una cuenta de correo electrónico para que le sea enviado el CFDI (recibos de nómina electrónicos y timbrado) que corresponda por el pago de sueldos y salarios, según lo dispuesto en el artículo 27, fracción V de la ley del impuesto sobre la renta, teniendo el trabajador un término de 30 días naturales contados a partir del día siguiente del depósito de su nómina o prestaciones legales para hacer valer alguna reclamación respecto al monto o días de salario, la cual deberá  de realizarse por escrito en las oficinas de “EL PATRÓN” acusando de recibido este, en caso de  no realizarlo se entenderá que está de acuerdo y se le está pagando conforme a lo pactado en el presente contrato. 
    </p>

    <p>
        Ambas partes están de acuerdo que el documento válido para comprobar montos y pagos de salarios están los CFDI (recibos de nómina electrónico y timbrado), siempre y cuando “EL TRABADOR” no haya presentado alguna reclamación como se menciona en el párrafo anterior. 
    </p>

    <p>
        QUINTA.- El trabajo será desempeñado bajo el siguiente horario; <b>{{wh_short_format($data->working_hours)}}</b>, dicha jornada laboral podrá ser modificada de acuerdo a las necesidades del patrón, pero siempre la jornada laboral será de 8 horas diarias  máxima, y no podrá exceder de 48 horas semanales, así mismo de conformidad con el artículo 69 de la Ley Federal del Trabajo, “ EL TRABAJADOR” tendrá derecho a un día de descanso por cada seis días laborados, el cual invariablemente será los días domingos como día de descanso con goce de sueldo íntegro. Por otro lado, las partes están de acuerdo que “EL TRABAJADOR” disfrutará de un periodo de 60 minutos diarios, intermedios dentro de la jornada laboral antes establecida, para el consumo de alimentos la cual podrá ser ocupada dentro del horario de 13:00 hoyas y 14:00 horas de lunes a sábado, dentro o fuera del centro de trabajo. 
    </p>

    <p>SEXTA.- Ambas partes están de acuerdo que “EL TRABAJADOR” tiene estrictamente prohibido trabajar jornada extraordinaria y solo podrá laborar en tiempo extraordinario con autorización expresa y por escrito de la parte patronal.</p>

    <p>SEPTIMA.- Ambas partes están de acuerdo que “EL TRABAJADOR”  hará constar cada día su asistencia mediante la firma del libro de asistencias, checador electrónico o similar; el incumplimiento de tal requisito se considera falta de asistencia para los efectos conducentes. </p>

    <p>OCTAVA.- “ EL TRABAJADOR” disfrutará de descanso con pago de salario íntegro los días a que se refiere el artículo 74 de la Ley Federal del Trabajo en vigor. </p>

    <p>NOVENA.- “EL TRABAJADOR” disfrutará de los días de descanso obligatorio y vacaciones, conforme a lo dispuesto en los artículos 76, 78, 79,80 y 81 de la Ley Federal Del Trabajo en vigor. Recibirá una prima vacacional equivalente al 25%del importe pagado por concepto de vacaciones. Asimismo, “EL TRABAJADOR” percibirá un aguinaldo anual equivalente a 15 días de salario, que le será pagado conforme al artículo 87 del ordenamiento en cita, a más tardar el 19 de diciembre de cada año.</p>

    <p>DECIMA.- Ambas partes están de acuerdo que para garantizar la Seguridad Social de “EL TRABAJADOR”, “EL PATRON”, a partir de la firma del presente contrato, estará obligado a inscribir ante el Instituto Mexicano Del Seguro Social a “EL TRABAJADOR”, como su trabajador aun estando dicha persona en periodo a prueba. </p>

    <p>DECIMA PRIMERA.- “EL TRABAJADOR” acepta someterse a los exámenes médicos que periódicamente establezca “EL PATRÓN” en los términos del artículo 134 de “LA LEY”, a fin de mantener en forma óptima sus facultades físicas e intelectuales, para el mejor desempeño de sus funciones. El médico que practique los reconocimientos será designado y retribuido por “EL PATRON”. </p>
    
    <p>
        DECIMA SEGUNDA.-  “EL TRABAJADOR” deberá integrarse a los planes, Programas y Comisiones Mixtas de Capacitación y Adiestramiento, así como a los de Seguridad e Higiene en el Trabajo que tiene constituidos “EL PATRON”, tomando parte activa dentro de los mismos según los cursos establecidos y medidas preventivas de riesgos de trabajo, durante el tiempo que preste sus servicios, los cuales deberán efectuarse cuando menos una vez al año, en la fecha en que decidan de común acuerdo las partes, lo anterior para no entorpecer sus actividades cotidianas. 
    </p>

    <p>DECIMA TERCERA.- “EL TRABAJADOR” acepta que cuando por razones convenientes para “EL PATRON”, éste modifique el horario de trabajo, día de descanso, actividad o departamento, deberá desempeñar su jornada en el que quede establecido, ya que sus actividades al servicio de “EL PATRON” son prioritarias y no se contraponen a otras que pudieran llegar a desarrollar. </p>

    <p>DECIMA CUARTA.- “EL TRABAJADOR” deberá dar fiel cumplimiento a las disposiciones contenidas en el artículo 134 de “ LA LEY” y que corresponden a las obligaciones de los trabajadores en el desempeño de sus labores al servicio de “ EL PATRÓN”. </p>

    <p>DECIMA QUINTA.- “ EL TRABAJADOR” deberá presentarse puntualmente a sus labores en el horario de trabajo establecido y firmar las listas de asistencia acostumbradas o checar su tarjeta de asistencia mediante reloj checador diariamente. En caso de retraso o falta de asistencia injustificada, será potestativo para “EL PATRÓN” admitirlo, y si lo hace cubrirá únicamente el tiempo efectivo de trabajo desarrollado. </p>

    <p>DECIMA SEXTA.-  Se conviene que “EL TRABAJADOR” tiene derecho a recibir ingresos por concepto de previsión social, de acuerdo al Plan de Previsión Social de “EL PATRON”, los cuales no se encuentran limitados de forma alguna, y están exentos al pago de impuesto sobre la renta. </p>

    <p>DECIMA SEPTIMA.- Ambas partes convienen que en lo no previsto en este contrato se aplicara lo dispuesto por la Ley Federal del Trabajo, del Reglamento Interior de Trabajo, y las demás correlativas y aplicables, cancelando y dejando sin efectos cualquier otro acuerdo verbal o escrito, que las partes pudieran haber celebrado con anterioridad, sometiéndose la pates a lo dispuesto por la Junta Local de Conciliación y Arbitraje de Jalisco, para el caso de controversia, por tal razón las partes renuncian a la competencia de cualquier otra junta por razón de lugar en donde se presten los servicios al final de la relación laboral. </p>

    <p>
        DECIMA OCTAVA. - “EL TRABAJADOR” reconoce como de propiedad exclusiva de “EL PATRON” o de los clientes de este, todos los documentos e información que se le proporcionen con motivo de la relación de trabajo, así como los que la propia “EL PATRÓN” prepare o formule en relación o conexión con sus servicios, por lo que se obliga a conservarlos en buen estado y a restituirlos a “EL PATRON” en el momento en que esta así lo requiera y/o bien al terminar el presente contrato, por el motivo que sea. Lo anterior atento a las políticas de “EL PATRON” y a lo dispuesto por el artículo 134 fracción VI de la Ley Federal del Trabajo. 
    </p>

    <p>
        DECIMA NOVENA.- “EL TRABAJADOR” bajo pena de rescisión de este contrato se obliga a no divulgar bajo cualquier forma algún aspecto confidencial o reservado de los negocios de “EL PATRON” o de los clientes de este, incluyendo información relativa a: <b>{{strtoupper($Company->business_name)}}</b> y de cualquier otra sociedad con la que la empresa tenga relaciones comerciales, ni proporcionará a terceras personas verbalmente o por escrito, directa o indirectamente, información alguna sobre los sistemas o actividades de cualquier clase que observe  en “EL PATRON” salvo que medie autorización expresa de este. Asimismo, las condiciones salariales o contractuales del presente instrumento o futuros convenios o acuerdos sobre este también tendrán el carácter de absolutamente confidenciales inclusive dentro de la propia “EMPRESA” o compañías relacionadas con esta, de conformidad con lo establecido en el artículo 134 fracción XIII de la Ley Federal del Trabajo. <br>
        En caso de incumplir con esta cláusula “EL TRABAJADOR” podrá ser demandado por la responsabilidad civil y los daños y perjuicios que ocasione a “EL PATRON” además de las acciones penales a que se haga acreedor. 
    </p>

    <p>
        VIGÉSIMA.- Manifiesta “EL PATRON” que con el fin de asegurar la protección y privacidad de los datos personales de “EL TRABAJADOR” que se encuentran en su posesión, así como para regular el acceso, rectificación, cancelación y oposición del tratamiento de los mismos, ha desarrollado una política de privacidad del manejo de dicha información en conformidad con los principios de la Ley Federal de protección de Datos Personales en Posesión de los Particulares y su Reglamento  respecto a las obligaciones derivadas de la relación laboral que se establece con “EL TRABAJADOR”, plasmadas en el Aviso de Privacidad, mismo que fue puesto a su disposición, dando su consentimiento expreso y por escrito para el tratamiento de sus datos personales normales, para el tratamiento de sus datos sensibles, así como para el tratamiento de sus datos financieros patrimoniales. Consentimiento que se expresa mediante la firma del presente contrato. 
    </p>

    <p>
        VIGÉSIMA PRIMERA. - “EL TRABAJADOR” en caso de fallecimiento o desaparición designa desde estos momentos como beneficiaros de sus derechos laborales a _________________________________________________ en los términos del artículo 501 de la Ley Federal del Trabajo. 
    </p>

    <p>
        VIGÉSIMA SEGUNDA. - Para el caso de que a “EL TRABAJADOR” se le asigne equipo de cómputo para el mejor cumplimiento de sus labores, estará obligado a emplear en dicho computador, solo programas o aplicaciones debidamente autorizadas por “EL PATRÓN”, que cuenten con licencia respectiva del titular del derecho de autor, o la persona autorizada por éste. Queda, por consiguiente, prohibido a “EL TRABAJADOR” introducir cualquier programa o aplicación que no se encuentre debidamente licenciada por el autor, o autorizada por “EL PATRON”. Queda también prohibido a “EL TRABAJADOR” efectuar alteraciones o modificaciones a dichos programas o aplicaciones, por mínimas que estas sean, a menos que cuente con una autorización expresa para ello. Del mismo modo deberá velar por la seguridad de la información contenida en los computadores propiedad de “EL PATRÓN” a los cuales tenga acceso, por lo que “EL PATRÓN” podrá en todo momento examinar el equipo de cómputo asignado sin autorización o   consentimiento de “EL TRABAJADOR”. Si “EL TRABAJADOR” no respetare las normas precedentes, será causa de rescisión del presente contrato sin responsabilidad para “EL PATRÓN”, además directa y exclusivamente responsable de las sanciones civiles o penales que procedan. 
    </p>

    <p>
        VIGÉSIMA TERCERA.- La empresa reconoce expresamente al trabajador una antigüedad a su servicio a partir del <b>{{ \Carbon\Carbon::parse($data->hired_date)->formatLocalized('%d de %B %Y') }}</b> . 
    </p>


    <div class="signature">
        <table>
            <tr>
                <td style="height: 55px;"></td>
                <td style="height: 55px;"></td>
            </tr>
            <tr>
                <td style="text-align: center;" valign="top" >
                    <p><b>{{strtoupper($Company->legal_representative)}}</b></p>
                    <small>Representante Legal de</small>
                    <p><b>{{strtoupper($Company->business_name)}}</b></p>
                </td>
                <td style="text-align: center" valign="top">
                    <p><b>C.{{strtoupper($data->name)}}</b></p>
                    <p><b>TRABAJADOR</b></p>                  
                </td>
            </tr>
        </table>
    </div>
</body>
</html>