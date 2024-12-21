<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial', sans-serif; /* Establecer la fuente */
            display: flex;
            align-items: center;
            margin: 0;
            font-size: 14px; /* Reduce el tamaño del texto */

            
        }

        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
            margin-top: -24px;

        }

        img {
            margin-left: 8px;
            width: 650px;
            height: 145px;
            margin-bottom: 0px;
        }
        img.whatsapp {
            margin-top: -101px;
            margin-right: 100px;
            margin-left: 0px;
            width: 120px;
            height: 120px;
            margin-bottom: 0px;
        }
        img.facebook {
            margin-top: -101px;
            margin-right: 0px;
            margin-left: 318px;
            width: 120px;
            height: 120px;
            margin-bottom: 0px;
        }

        p {
            text-align: justify;
            margin-bottom: 5px;
            position: relative;
        }

        p::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0%;
            height: 2px;
            background-color: #000;
        }

        p.uppercase {
            text-transform: uppercase;
        }

        p.with-line::after {
            content: '\00a0';
        }

        hr {
            border: none;
            border-top: 1px solid #000;
            width: 98%;
            margin-left: auto;
            margin-right: 0;
            margin-top: -10px;
        }

        .flex-item1 {
            display: inline-block;
            width: 30%;
            text-align: right;
            margin-top: 0px; /* Ajusta el margen superior */
            margin-bottom: 5px; /* Ajusta el margen inferior común */
        }
        .flex-item2 {
            display: inline-block;
            width: 69%;
            text-align: right;
            margin-top: 0px; /* Ajusta el margen superior */
            margin-bottom: 0px; /* Ajusta el margen inferior común */
        }
        

        .flex-item:last-child {
            margin-bottom: 2px; /* Ajusta el margen inferior específico para Telefono */
        }

        .flex-item p {
            margin: 0; /* Elimina el margen predeterminado de los párrafos */
        }

        .content-container > p:last-child {
            margin-bottom: 20px;
        }

        hr.line1 {
            border: none;
            border-top: 1px solid black; /* Cambiar el color de la primera línea */
            width: 97%;
            margin-left: auto;
            margin-right: 0;
            margin-top: -7px;
        }
        hr.line2 {
            border: none;
            border-top: 1px solid black;
            width: 115%;
            margin-left: 75px;
            margin-right: 0;
            position: relative;
            top: 3px; /* Ajusta el valor de posición superior */
        }

        hr.line3 {
            border: none;
            border-top: 1px solid black;
            width: 57%;
            margin-left: 43%; /* Ajusta el valor de margen izquierdo */
            margin-right: 0;
            position: relative;
            top: -0px; /* Ajusta el valor de posición superior */
        }

        p.uppercase.placa {
            margin-top: 10px; /* Ajusta el margen superior negativo según sea necesario */
        }
        p.uppercase.telefono {
            margin-left: 75;
            margin-right: 0;
            margin-top: -15;
        }
        hr.line4 {
            border: none;
            border-top: 1px solid black; /* Cambiar el color de la cuarta línea */
            width: 85%;
            margin-left: 75;
            margin-right: 0;
            margin-top: -3px;
        }
        p.uppercase.direccion {
            margin-top: 2px; /* Ajusta el margen superior negativo según sea necesario */
        }
        hr.line5 {
            border: none;
            border-top: 1px solid black; /* Cambiar el color de la cuarta línea */
            width: 88%;
            margin-left: 81px;
            margin-right: 0px;
            margin-top: -0px;
        }
        p.uppercase.modelo {
            margin-top: 23px; /* Ajusta el margen superior negativo según sea necesario */
        }
        hr.line6 {
            border: 1px solid black;
            border-top: 0px ; /* Cambiar el color de la cuarta línea */
            width: 88%;
            margin-left: 81px;
            margin-right: 0px;
            margin-top: -5px;
        }
        p.uppercase.marca {
            margin-top: 23px; /* Ajusta el margen superior negativo según sea necesario */
        }
        hr.line7 {
            border: none;
            border-top: 1px solid black; /* Cambiar el color de la cuarta línea */
            width: 90%;
            margin-left: 65px;
            margin-right: 0px;
            margin-top: -7px;
        }
        p.uppercase.tipo {
            margin-top: 23px; /* Ajusta el margen superior negativo según sea necesario */
        }
        hr.line8 {
            border: none;
            border-top: 1px solid black; /* Cambiar el color de la cuarta línea */
            width: 93%;
            margin-left: 45px;
            margin-right: 0px;
            margin-top: -7px;
        }
        p.uppercase.serie {
            margin-top: 23px; /* Ajusta el margen superior negativo según sea necesario */
        }
        hr.line9 {
            border: none;
            border-top: 1px solid black; /* Cambiar el color de la cuarta línea */
            width: 92%;
            margin-left: 55px;
            margin-right: 0px;
            margin-top: -6px;
        }
        p.uppercase.color {
            margin-top: 23px; /* Ajusta el margen superior negativo según sea necesario */
        }
        hr.line10 {
            border: none;
            border-top: 1px solid black; /* Cambiar el color de la cuarta línea */
            width: 90%;
            margin-left: 67px;
            margin-right: 0px;
            margin-top: -6px;
        }
        p.uppercase.lugar {
            margin-top: 23px; /* Ajusta el margen superior negativo según sea necesario */
        }
        hr.line11 {
            border: none;
            border-top: 1px solid black;
            width: 105%;
            margin-left: 64px;
            margin-right: 0;
            position: relative;
            top: 5px; /* Ajusta el valor de posición superior */
        }

        hr.line12 {
            border: none;
            border-top: 1px solid black;
            width: 115%;
            margin-left: 40%; /* Ajusta el valor de margen izquierdo */
            margin-right: 0;
            position: relative;
            top: 5px; /* Ajusta el valor de posición superior */
        }

        p.uppercase.fecha {
            margin-left: 0px; /* Ajusta el margen izquierdo */
            margin-right: 100px;
            margin-top: -0px;
        }
        .flex-item3 {
            display: inline-block;
            width: 30%;
            text-align: right;
            margin-top: 0px; /* Ajusta el margen superior */
            margin-bottom: 10px; /* Ajusta el margen inferior común */
        }
        .flex-item4 {
            display: inline-block;
            width: 45%;
            text-align: right;
            margin-top: 0px; /* Ajusta el margen superior */
            margin-bottom: 10px; /* Ajusta el margen inferior común */
        }
        p.mientras {
            text-align: center;        
            font-size: 14px; /* Reduce el tamaño del texto */
            margin-top: -7px;
        }
        p.eym {
            margin-top: -2px;
            text-align: center;
            font-size: 25px; /* Reduce el tamaño del texto */
            color: red; /* Cambiar el color del texto a rojo */
            font-family: 'Franklin Gothic Medium', 'Arial', sans-serif; /* Establecer la fuente */
            font-weight: bold; /* Hacer que el texto sea negrita */
        }
        p.pie1 {
            margin-left: 150px; /* Ajusta el margen izquierdo */
            margin-right: 150px;
            margin-top: -2px;
            text-align: center;
            font-size: 13px; /* Reduce el tamaño del texto */
            color: black; /* Cambiar el color del texto a rojo */
            font-family: 'Franklin Gothic Medium', 'Arial', sans-serif; /* Establecer la fuente */
            font-weight: bold; /* Hacer que el texto sea negrita */
        }
        p.pie2 {
            margin-left: 150px; /* Ajusta el margen izquierdo */
            margin-right: 150px;
            margin-top: -2px;
            text-align: center;
            font-size: 15px; /* Reduce el tamaño del texto */
            color: black; /* Cambiar el color del texto a rojo */
            font-family: 'Franklin Gothic Medium', 'Arial', sans-serif; /* Establecer la fuente */
            font-weight: bold; /* Hacer que el texto sea negrita */
        }

        hr.line13 {
            margin-top: -2px;
        }
        
    </style>
</head>
<body>
    <div class="content-container">
        <img src="{{ public_path('images/logo_pdf.png') }}" alt="Descripción de la imagen">
        <p>La Asociación de <span style="font-weight: bold;">EYM ALIANZA UNIDA A.C.</span> es una organización dedicada a la gestión, asesoramiento y regularización de Autotransporte, siendo uno de los logros a apoyar el proceso de regularización de los vehículos de procedencia extranjera, siendo interlocutores ante las instituciones gubernamentales para
            <span style="font-weight: bold;">PLANTEAR LA PROBLEMÁTICA VEHICULAR PARA DAR SOLUCION Y LEGALIDAD ANTES LAS AUTORIDADES, SEGOB, SHCP, CONGRESO DE LA UNION, PGR, PFP, SCT </span>y que han estado evaluando permanentemente.
            Por tal motivo y razón de nuestros estatus que marca la formación de cooperativas de transporte para facilitar a campesinos y ciudadanos de escasos recursos de transporte.
            En apoyo a su economía, fomentando el empleo y patrimonio familiar, solicitamos las facilidades necesarias para la vialidad y libre tránsito en las carreteras locales y su valle de las unidades pertenecientes a nuestra organización, ya que no hacerlo se estarán violando los artículos 5,8,14,16,22 y 103 de la Constitución Política de los Estados Unidos Mexicanos.
        </p>
        <p>Por medio de la presente, nos permitimos informarles que el</p>
        <p class="uppercase nombre" style="text-transform: uppercase;">
            <span style="font-weight: bold;">c:</span>
            <span style="font-size: 13px;">

            {{ strtoupper($afiliacion->nombre_uno) }} {{ strtoupper($afiliacion->ap_paterno_uno) }} {{ strtoupper($afiliacion->ap_materno_uno) }}
            @if($afiliacion->nombre_dos)
                , {{ strtoupper($afiliacion->nombre_dos) }} {{ strtoupper($afiliacion->ap_paterno_dos) }} {{ strtoupper($afiliacion->ap_materno_dos) }}  
            @endif   
            <hr class="line13">
            @if($afiliacion->nombre_tres)
            , {{ strtoupper($afiliacion->nombre_tres) }} {{ strtoupper($afiliacion->ap_paterno_tres) }} {{ strtoupper($afiliacion->ap_materno_tres) }}
            @endif
            </span>
        </p>

        <hr class="line1">
        <p>Es miembro activo de la asociación <span style="font-weight: bold;">EYM ALIANZA UNIDA A.C.</span> y es poseedor y conductor del vehículo de las siguientes características</p>
        <div class="flex-item1">
            <p class="uppercase placa">            
                <span style="font-weight: bold;">Placas:</span>
                {{ ($afiliacion->placa) }}
            </p>
            <hr class="line2">
        </div>
        <div class="flex-item2">
            <p class="uppercase telefono">
                <span style="font-weight: bold;">Telefono:</span>
                {{ ($afiliacion->tel_uno) }}
            </p>
            <hr class="line3">
        </div>
        <p class="uppercase direccion">
            <span style="font-weight: bold;">Direccion:</span>
            {{ ($afiliacion->colonia) }} {{ ($afiliacion->calle) }} {{ ($afiliacion->no_casa) }}</P>
            <hr class="line4">  
        <p class="uppercase modelo"> 
            <span style="font-weight: bold;">Modelo:</span>
            {{ ($afiliacion->modelo) }}
        </P>
            <hr class="line6">  
        <p class="uppercase marca">
            <span style="font-weight: bold;">Marca:</span>
            {{ ($afiliacion->marca) }}
        </P>
            <hr class="line7"> 
        <p class="uppercase tipo">            
            <span style="font-weight: bold;">Tipo:</span>
            {{ ($afiliacion->tipo) }}
        </P>
            <hr class="line8"> 
        <p class="uppercase serie">
            <span style="font-weight: bold;">Serie:</span>
            {{ ($afiliacion->serie) }}
        </P>
            <hr class="line9"> 
        <p class="uppercase color">
            <span style="font-weight: bold;">Color:</span>
            {{ ($afiliacion->color) }}
        </P>
            <hr class="line10"> 
        <div class="flex-item3">
        <p class="uppercase lugar">
            <span style="font-weight: bold;">Lugar:</span>
            {{ $afiliacion->municipio }}
        </p>
            <hr class="line11">
        </div>
        <div class="flex-item4">
            <p class="uppercase fecha" style="text-align: right;">
                <span style="font-weight: bold;">Fecha:</span>
                {{ date('Y-m-d', strtotime($afiliacion->created_at)) }}
            </p>
            <hr class="line12">
        </div>
        <p class="mientras">
            <span>Mientras los estados y gobiernos les asignan la normativa para el pago de impuestos y obligaciones, </span>
            <span>agradecemos de antemano las facilidades otorgadas a nuestros representados.</span>
        </p>
        <p style="text-align:center"><span>A T E N T A M E N T E</span></p>
        <p class="eym">EYM ALIANZA UNIDA A.C.</p>
        <p class="pie1">
            <spam>“JUSTICIA Y EQUIDAD PARA LA SOCIEDAD”</spam>
        </p>
        <p class="pie1">
            <spam>BLVD PASEO LAS LOMAS COL. LAS LOMAS TEL. 6621683694</spam>
        </p>
        <img class="whatsapp"src="{{ public_path('images/wha.png') }}" alt="Codigo QR whatsapp"> 
        <img class="facebook"src="{{ public_path('images/qrface.png') }}" alt="Codigo QR Facebook">
    </div>
</body>
</html>
