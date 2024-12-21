@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="row" style="margin: 10px; margin-top: 5px;">
    <!-- Formulario para creación individual -->
    <p class="icon-text">
        <span class="material-symbols-outlined sub">sell</span>
        Nueva Afiliacion
    </p>
    <div class="col-12" style="padding: 5px;">
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <p style="font-size: 20px; color: #125e2b; margin-bottom: 0;">Formulario para creación de nueva afiliacion.</p>
            </div>
            <p style="color: #6f6f6f; margin-bottom: 0;">En el siguiente formulario, llene los datos solicitados para la creación de una nueva afiliacion.</p><br>
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 0; margin-bottom: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('afiliaciones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- --------------------------------------------------------------------------------------------------------------- --}}
                <div class="row" style="padding: 10px; margin-top: 15px; margin-bottom: 10px">
                    <div class="col-12" style="background-color:#618571; color: white; text-align: center; vertical-align: middle;">
                        <p style="margin: 0px; font-weight: bold">Conductores</p>
                    </div>
                </div>
                <button type="button" id="mostrarCampos" class="btn btn-success">Agregar Conductor</button>
                <button type="button" id="ocultarCampos" class="btn btn-warning" style="display: none;">Ocultar</button>
                <div class="row">
                    <div class="col-3">
                        <label for="nombre_uno">Nombre(s):</label>
                        <input type="text" name="nombre_uno" class="form-control" id="nombre_uno" style="text-transform: uppercase;" value="{{ old('nombre_uno') }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_paterno_uno">Apellido Paterno:</label>
                        <input type="text" name="ap_paterno_uno" class="form-control" id="ap_paterno_uno" style="text-transform: uppercase;" value="{{ old('ap_paterno_uno') }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_materno_uno">Apellido Materno:</label>
                        <input type="text" name="ap_materno_uno" class="form-control" id="ap_materno_uno" style="text-transform: uppercase;" value="{{ old('ap_materno_uno') }}">
                    </div>
                    <div class="col-3">
                        <label for="tel_uno">Telefono:</label>
                        <input type="number" name="tel_uno" class="form-control" id="tel_uno" value="{{ old('tel_uno') }}" data-inputmask="'mask': '(999) 999-9999'">
                    </div>


                </div>
                <div class="row" id="conjunto-dos" style="display: none;">
                    <div class="col-3">
                        <label for="nombre_dos">Nombre(s):</label>
                        <input type="text" name="nombre_dos" class="form-control" id="nombre_dos" style="text-transform: uppercase;" value="{{ old('nombre_dos') }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_paterno_dos">Apellido Paterno:</label>
                        <input type="text" name="ap_paterno_dos" class="form-control" id="ap_paterno_dos" style="text-transform: uppercase;" value="{{ old('ap_paterno_dos') }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_materno_dos">Apellido Materno:</label>
                        <input type="text" name="ap_materno_dos" class="form-control" id="ap_materno_dos" style="text-transform: uppercase;" value="{{ old('ap_materno_dos') }}">
                    </div>
                    <div class="col-3">
                        <label for="tel_dos">Telefono:</label>
                        <input type="number" name="tel_dos" class="form-control" id="tel_dos" style="text-transform: uppercase;" value="{{ old('tel_dos') }}" data-inputmask="'mask': '(999) 999-9999'">
                    </div>
                </div>
                <div class="row" id="conjunto-tres" style="display: none;">
                    <div class="col-3">
                        <label for="nombre_tres">Nombre(s):</label>
                        <input type="text" name="nombre_tres" class="form-control" id="nombre_tres" style="text-transform: uppercase;" value="{{ old('nombre_tres') }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_paterno_tres">Apellido Paterno:</label>
                        <input type="text" name="ap_paterno_tres" class="form-control" id="ap_paterno_tres" style="text-transform: uppercase;" value="{{ old('ap_paterno_tres') }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_materno_tres">Apellido Materno:</label>
                        <input type="text" name="ap_materno_tres" class="form-control" id="ap_materno_tres" style="text-transform: uppercase;" value="{{ old('ap_materno_tres') }}">
                    </div>
                    <div class="col-3">
                        <label for="tel_tres">Telefono:</label>
                        <input type="number" name="tel_tres" class="form-control" id="tel_tres" style="text-transform: uppercase;" value="{{ old('tel_tres') }}" data-inputmask="'mask': '(999) 999-9999'">
                    </div>
                </div>
                <div class ="row">
                    <div class="col-2">
                        <label for="municipio">Municipio:</label>
                        <select name="municipio" class="form-control" id="municipio" style="text-transform: uppercase;" value="{{ old('municipio') }}">
                            <option value="Aconchi">Aconchi</option>
                            <option value="Agua Prieta">Agua Prieta</option>
                            <option value="Alamos">Álamos</option>
                            <option value="Altar">Altar</option>
                            <option value="Arivechi">Arivechi</option>
                            <option value="Bacadehuachi">Bacadéhuachi</option>
                            <option value="Bacanora">Bacanora</option>
                            <option value="Bacerac">Bacerac</option>
                            <option value="Bacoachi">Bacoachi</option>
                            <option value="Bácum">Bácum</option>
                            <option value="Banámichi">Banámichi</option>
                            <option value="Baviácora">Baviácora</option>
                            <option value="Bavispe">Bavispe</option>
                            <option value="Benjamín Hill">Benjamín Hill</option>
                            <option value="Caborca">Caborca</option>
                            <option value="Cajeme">Cajeme</option>
                            <option value="Cananea">Cananea</option>
                            <option value="Carbó">Carbó</option>
                            <option value="Cucurpe">Cucurpe</option>
                            <option value="Divisaderos">Divisaderos</option>
                            <option value="Empalme">Empalme</option>
                            <option value="Etchojoa">Etchojoa</option>
                            <option value="Fronteras">Fronteras</option>
                            <option value="General Plutarco Elías Calles">General Plutarco Elías Calles</option>
                            <option value="Granados">Granados</option>
                            <option value="Guaymas">Guaymas</option>
                            <option value="Hermosillo" selected >Hermosillo</option>
                            <option value="Huachinera">Huachinera</option>
                            <option value="Huásabas">Huásabas</option>
                            <option value="Huatabampo">Huatabampo</option>
                            <option value="Huépac">Huépac</option>
                            <option value="Imuris">Imuris</option>
                            <option value="La Colorada">La Colorada</option>
                            <option value="Magdalena">Magdalena</option>
                            <option value="Mazatán">Mazatán</option>
                            <option value="Moctezuma">Moctezuma</option>
                            <option value="Naco">Naco</option>
                            <option value="Nácori Chico">Nácori Chico</option>
                            <option value="Nacozari de García">Nacozari de García</option>
                            <option value="Navojoa">Navojoa</option>
                            <option value="Nogales">Nogales</option>
                            <option value="Onavas">Onavas</option>
                            <option value="Opodepe">Opodepe</option>
                            <option value="Oquitoa">Oquitoa</option>
                            <option value="Pitiquito">Pitiquito</option>
                            <option value="Puerto Peñasco">Puerto Peñasco</option>
                            <option value="Quiriego">Quiriego</option>
                            <option value="Rayón">Rayón</option>
                            <option value="Rosario">Rosario</option>
                            <option value="Sahuaripa">Sahuaripa</option>
                            <option value="San Felipe de Jesús">San Felipe de Jesús</option>
                            <option value="San Ignacio Río Muerto">San Ignacio Río Muerto</option>
                            <option value="San Javier">San Javier</option>
                            <option value="San Luis Río Colorado">San Luis Río Colorado</option>
                            <option value="San Miguel de Horcasitas">San Miguel de Horcasitas</option>
                            <option value="San Pedro de la Cueva">San Pedro de la Cueva</option>
                            <option value="Santa Ana">Santa Ana</option>
                            <option value="Santa Cruz">Santa Cruz</option>
                            <option value="Sáric">Sáric</option>
                            <option value="Soyopa">Soyopa</option>
                            <option value="Suaqui Grande">Suaqui Grande</option>
                            <option value="Tepache">Tepache</option>
                            <option value="Trincheras">Trincheras</option>
                            <option value="Tubutama">Tubutama</option>
                            <option value="Ures">Ures</option>
                            <option value="Villa Hidalgo">Villa Hidalgo</option>
                            <option value="Villa Pesqueira">Villa Pesqueira</option>
                            <option value="Yécora">Yécora</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="calle">Calle:</label>
                        <input type="text" name="calle" class="form-control" id="calle" style="text-transform: uppercase;" value="{{ old('calle') }}">
                    </div>
                    <div class="col-1">
                        <label for="no_casa">No. casa:</label>
                        <input type="text" name="no_casa" class="form-control" id="no_casa" style="text-transform: uppercase;" value="{{ old('no_casa') }}" pattern="[0-9]+" title="Ingrese solo números">
                    </div>
                    <div class="col-3">
                        <label for="colonia">Colonia:</label>
                        <input type="text" name="colonia" class="form-control" id="colonia" style="text-transform: uppercase;" value="{{ old('colonia') }}">
                    </div>
                    <div class="col-2">
                        <label for="seccion">Seccion:</label>
                        <input type="text" name="seccion" class="form-control" id="seccion" style="text-transform: uppercase;" value="{{ old('seccion') }}">
                    </div>
                </div>
                {{-- --------------------------------------------------------------------------------------------------------------- --}}
                <div class="row" style="padding: 10px; margin-top: 15px; margin-bottom: 10px">
                    <div class="col-12" style="background-color:#618571; color: white; text-align: center; vertical-align: middle;">
                        <p style="margin: 0px; font-weight: bold">Datos del Vehiculo</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="placa">Numero de Placa:</label>
                        <input type="text" name="placa" class="form-control" id="placa" style="text-transform: uppercase;" value="{{ old('placa') }}">
                    </div>
                    <div class="col-2">
                        <label for="modelo">Modelo:</label>
                        <input type="number" name="modelo" class="form-control" id="modelo" style="text-transform: uppercase;" value="{{ old('modelo') }}" pattern="[0-9]+" title="Ingrese solo números">
                    </div>
                    <div class="col-3">
                        <label for="marca">Marca:</label>
                        <input type="text" name="marca" class="form-control" id="marca" style="text-transform: uppercase;" value="{{ old('marca') }}">
                    </div>
                    <div class="col-3">
                        <label for="tipo">Tipo:</label>
                        <input type="text" name="tipo" class="form-control" id="tipo" style="text-transform: uppercase;" value="{{ old('tipo') }}">
                    </div>
                    <div class="col-2">
                        <label for="color">Color:</label>
                        <input type="text" name="color" class="form-control" id="color" style="text-transform: uppercase;" value="{{ old('color') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="serie">Serie (VIN):</label>
                        <input type="text" name="serie" class="form-control" id="serie" style="text-transform: uppercase;" value="{{ old('serie') }}" minlength="17" maxlength="17">
                    </div>
                    <div class="col-6 align-self-end">
                        <p id="vehicle-info" style="display: none;">
                            <strong>Marca:</strong> <span id="vehicle-make">{{ $vehicleData['Results'][0]['Value'] ?? 'N/A' }}</span> |
                            <strong>Modelo:</strong> <span id="vehicle-model">{{ $vehicleData['Results'][1]['Value'] ?? 'N/A' }}</span> |
                            <strong>Año:</strong> <span id="vehicle-year">{{ $vehicleData['Results'][2]['Value'] ?? 'N/A' }}</span>
                        </p>
                    </div>


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#serie').change(function () {
                            let vin = $(this).val();

                            if (vin.length === 17) {
                                $.ajax({
                                    url: '{{ route("afiliaciones.decode-vin") }}',
                                    method: 'GET',
                                    data: { vin: vin },
                                    success: function (data) {
                                        const results = data.Results;
                                        const make = results.find(item => item.Variable === 'Make')?.Value || 'N/A';
                                        const model = results.find(item => item.Variable === 'Model')?.Value || 'N/A';
                                        const year = results.find(item => item.Variable === 'Model Year')?.Value || 'N/A';

                                        $('#vehicle-info').show();
                                        $('#vehicle-make').text(make);
                                        $('#vehicle-model').text(model);
                                        $('#vehicle-year').text(year);
                                    },
                                    error: function () {
                                        alert('No se pudo obtener la información del VIN.');
                                    }
                                });
                            } else {
                                alert('El VIN debe tener 17 caracteres.');
                            }
                        });
                    });
                </script>

                {{-- --------------------------------------------------------------------------------------------------------------- --}}
                <div class="row" style="padding: 10px; margin-top: 15px; margin-bottom: 10px">
                    <div class="col-12" style="background-color:#618571; color: white; text-align: center; vertical-align: middle;">
                        <p style="margin: 0px; font-weight: bold">Pago</p>
                    </div>
                </div>
                <div>
                    <div class="col-4">
                        <label for="metodo_pago">Metodo de pago</label>
                        <select name="metodo_pago" class="form-control" value="{{ old('metodo_pago') }}">
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta">Tarjeta</option>
                            <option value="Transferencia">Transferencia</option>
                        </select>
                    </div>
                </div>
                {{-- --------------------------------------------------------------------------------------------------------------- --}}
                <div class="row" style="padding: 10px; margin-top: 15px; margin-bottom: 10px">
                    <div class="col-12" style="background-color:#618571; color: white; text-align: center; vertical-align: middle;">
                        <p style="margin: 0px; font-weight: bold">Seguro de Vehiculo</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="tramito_seguro">¿Tramito Seguro?</label>
                        <select name="tramito_seguro" class="form-control" id="seguroSelect" value="{{ old('tramito_seguro') }}">
                            <option value="No">No</option>
                            <option value="SI">Si</option>
                        </select>
                    </div>
                    <div class="col-2" id="tipoSeguroContainer" style="display: none;">
                        <label for="tipo_seguro">Tipo de seguro</label>
                        <select name="tipo_seguro" class="form-control" id="tipoSeguro" value="{{ old('tipo_seguro') }}">
                            <option value="Qualitas">Qualitas $150,000</option>
                            <option value="Ana Seguros">Ana Seguros $420,000</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-2" id="numeroSeguroContainer" style="display: none;">
                        <label for="no_poliza">No. Poliza:</label>
                        <input type="number" name="no_poliza" class="form-control" id="no_poliza" style="text-transform: uppercase;" value="{{ old('no_poliza') }}">
                    </div>
                    <div class="col-6" id="detallesSeguroContainer" style="display: none;">
                        <label for="descripcion_seguro">Detalles:</label>
                        <input type="text" name="descripcion_seguro" class="form-control" id="descripcion_seguro" style="text-transform: uppercase;" value="{{ old('descripcion_seguro') }}">
                    </div>
                </div>
                <br>
                <div style="text-align: end">
                    <a href="/afiliaciones" class="btn btn-outline-secondary">Regresar</a>
                    <button type="submit" id="btnCrear" class="btn btn-success" onclick="this.disabled=true; this.innerHTML='Enviando...'; this.form.submit();">Crear Afiliacion</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        let conjuntoActual = 1;

        $("#mostrarCampos").click(function () {
            if (conjuntoActual === 1) {
                $("#conjunto-dos").show();
                conjuntoActual = 2;
            } else if (conjuntoActual === 2) {
                $("#conjunto-tres").show();
                conjuntoActual = 3;
            }
            $("#ocultarCampos").show();
        });

        $("#ocultarCampos").click(function () {
            if (conjuntoActual === 3) {
                limpiarCampos("#conjunto-tres");
                $("#conjunto-tres").hide();
                conjuntoActual = 2;
            } else if (conjuntoActual === 2) {
                limpiarCampos("#conjunto-dos");
                $("#conjunto-dos").hide();
                conjuntoActual = 1;
                $("#ocultarCampos").hide();
            }
        });

        function limpiarCampos(selector) {
            $(selector + " input[type=text]").val('');
            $(selector + " input[type=numeric]").val('');
        }
    });
</script>

<script>
    $('#seguroSelect').change(function () {
    var selectedOption = $(this).val();
    
    if (selectedOption === 'SI') {
        // Mostrar los campos correspondientes
        $('#tipoSeguroContainer').show();
        $('#numeroSeguroContainer').show();
        $('#detallesSeguroContainer').show();
    } else if (selectedOption === 'No') {
        // Ocultar los campos y borrar su contenido
        $('#tipoSeguroContainer').hide();
        $('#numeroSeguroContainer').hide();
        $('#detallesSeguroContainer').hide();
        
        // Borrar los valores de los campos
        $('#tipoSeguro').val('');
        $('#no_poliza').val('');
        $('#descripcion_seguro').val('');
    }
});

$('#tipoSeguro').change(function () {
    var selectedTipoSeguro = $(this).val();
    
    if (selectedTipoSeguro === 'Otro') {
        $('#detallesSeguroContainer').show();
        $('#numeroSeguroContainer').hide();
    } else if (selectedTipoSeguro === 'Qualitas' || selectedTipoSeguro === 'Ana Seguros') {
        $('#numeroSeguroContainer').show();
        $('#detallesSeguroContainer').hide();
    } else {
        $('#numeroSeguroContainer').hide();
        $('#detallesSeguroContainer').hide();
    }
});

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("miFormulario").addEventListener("submit", function() {
            document.getElementById("btnCrear").setAttribute("disabled", "disabled");
        });
    });
</script>


@endsection
