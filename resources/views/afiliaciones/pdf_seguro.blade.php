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
            font-size: 16px; /* Reduce el tamaño del texto */
        }
        .fecha {
            font-size: 18px; /* Ajusta el tamaño según prefieras */
            text-align: right;
        }
        .recibo {
            margin-top: 20%;
        }
        .contenido {
            margin-top: 5%;
        }
        .atenta {
            margin-top: 20%;
            text-align: center;
        }
        .alianza {
            margin-top: 25%;
            text-align: center;
        }
        .footer {
            margin-top: 20%;        
        }
    </style>
</head>
<body>
    <div class="header">
        <p class="fecha"> Hermosillo, Sonora, a {{ \Carbon\Carbon::now()->translatedFormat('j \d\e F \d\e\l Y') }}</p>
    </div>
    <div class="body">
        <p class="recibo"> RECIBO DE PAGO DE PRIMA</p>
        <p class="contenido">
            RECIBI DE <strong>{{ strtoupper($afiliacion->nombre_uno) }} {{ strtoupper($afiliacion->ap_paterno_uno) }} {{ strtoupper($afiliacion->ap_materno_uno) }}</strong>
            LA CANTIDAD DE      
                @if ($afiliacion->tipo_seguro == 'Ana Seguros')
                    <strong>${{ number_format(2500, 2) }}</strong> 
                @elseif ($afiliacion->tipo_seguro == 'Qualitas')
                    <strong>${{ number_format(2100, 2) }}</strong> <!-- Imprime $2,100.00 -->
                @else
                    <strong>{{ '________________' }}</strong> 
                @endif
            POR CONCEPTO DE PAGO DE POLIZA NUMERO <strong>{{ $afiliacion->no_poliza }}</strong> DE LA COMPAÑÍA DE SEGUROS <strong>{{ strtoupper($afiliacion->tipo_seguro) }}</strong>
            QUE AMPARA LA UNIDAD MARCA <strong> {{ strtoupper($afiliacion->marca) }}</strong> 
            TIPO <strong> {{ strtoupper($afiliacion->tipo) }}</strong> 
            MODELO <strong> {{ strtoupper($afiliacion->modelo) }}</strong> 
        </p>
        <p class="atenta">A T E N T A M E N T E</p>
        <p class="alianza">Alianza Unida A.C.</p>
    </div>
    <div class="footer">
        <p class="footer">
            EN CASO DE TENER ALGUN INCOVENIENTE EN EL LUGAR DEL SINIESTRO FAVOR DE
            MARCAR AL <span style="color: red;">686-415-1594</span> CON JANET IBARRA.</p>

        </p>
    </div>
</body>
</html>
