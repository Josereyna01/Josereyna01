@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="row" style="margin: 10px; margin-top: 5px;">
    <!-- Formulario para edición de cliente existente -->
    <p style="font-size: 20px; font-weight: bold; color: #6f6f6f; margin: 0px"><span class="material-symbols-outlined sub">edit</span>Editar Afiliacion</p>
    <div class="col-12" style="padding: 5px;">
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <p style="font-size: 20px; color: #125e2b; margin-bottom: 0;">Formulario para edición de una afiliacion existente.</p>
            </div>
            <p style="color: #6f6f6f; margin-bottom: 0;">En el siguiente formulario, puede editar los datos de la afiliacion.</p><br>
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 0; margin-bottom: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('afiliaciones.update', $afiliacion->id) }}" method="POST">
                @csrf
                @method('PUT') 

                {{-- --------------------------------------------------------------------------------------------------------------- --}}
                <div class="row" style="padding: 10px;  margin-bottom: 10px">
                    <div class="col-12" style="background-color:#618571; color: white; text-align: center; vertical-align: middle;">
                        <p style="margin: 0px; font-weight: bold">Conductores</p>
                    </div>
                </div>
                <button type="button" id="mostrarCampos" class="btn btn-success">Agregar Conductor</button>
                <button type="button" id="ocultarCampos" class="btn btn-warning" style="display: none;">Ocultar</button>
                <div class="row">
                    <div class="col-3">
                        <label for="nombre_uno">Nombre(s):</label>
                        <input type="text" name="nombre_uno" class="form-control" id="nombre_uno" style="text-transform: uppercase;" value="{{ ($afiliacion->nombre_uno) }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_paterno_uno">Apellido Paterno:</label>
                        <input type="text" name="ap_paterno_uno" class="form-control" id="ap_paterno_uno" style="text-transform: uppercase;" value="{{ ($afiliacion->ap_paterno_uno) }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_materno_uno">Apellido Materno:</label>
                        <input type="text" name="ap_materno_uno" class="form-control" id="ap_materno_uno" style="text-transform: uppercase;" value="{{ ($afiliacion->ap_materno_uno) }}">
                    </div>
                    <div class="col-3">
                        <label for="tel_uno">Telefono:</label>
                        <input type="text" name="tel_uno" class="form-control" id="tel_uno" data-inputmask="'mask': '(999) 999-9999'" value="{{ ($afiliacion->tel_uno) }}">
                    </div>


                </div>
                <div class="row" id="conjunto-dos" style="display: none;">
                    <div class="col-3">
                        <label for="nombre_dos">Nombre(s):</label>
                        <input type="text" name="nombre_dos" class="form-control" id="nombre_dos" style="text-transform: uppercase;" value="{{ ($afiliacion->nombre_dos) }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_paterno_dos">Apellido Paterno:</label>
                        <input type="text" name="ap_paterno_dos" class="form-control" id="ap_paterno_dos" style="text-transform: uppercase;" value="{{ ($afiliacion->ap_paterno_dos) }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_materno_dos">Apellido Materno:</label>
                        <input type="text" name="ap_materno_dos" class="form-control" id="ap_materno_dos" style="text-transform: uppercase;" value="{{ ($afiliacion->ap_materno_dos) }}">
                    </div>
                    <div class="col-3">
                        <label for="tel_dos">Telefono:</label>
                        <input type="text" name="tel_dos" class="form-control" id="tel_dos" style="text-transform: uppercase;" data-inputmask="'mask': '(999) 999-9999'" value="{{ ($afiliacion->tel_dos) }}">
                    </div>
                </div>
                <div class="row" id="conjunto-tres" style="display: none;">
                    <div class="col-3">
                        <label for="nombre_tres">Nombre(s):</label>
                        <input type="text" name="nombre_tres" class="form-control" id="nombre_tres" style="text-transform: uppercase;" value="{{ ($afiliacion->nombre_tres) }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_paterno_tres">Apellido Paterno:</label>
                        <input type="text" name="ap_paterno_tres" class="form-control" id="ap_paterno_tres" style="text-transform: uppercase;" value="{{ ($afiliacion->ap_paterno_tres) }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_materno_tres">Apellido Materno:</label>
                        <input type="text" name="ap_materno_tres" class="form-control" id="ap_materno_tres" style="text-transform: uppercase;" value="{{ ($afiliacion->ap_materno_tres) }}">
                    </div>
                    <div class="col-3">
                        <label for="tel_tres">Telefono:</label>
                        <input type="text" name="tel_tres" class="form-control" id="tel_tres" style="text-transform: uppercase;" data-inputmask="'mask': '(999) 999-9999'" value="{{ ($afiliacion->tel_tres) }}">
                    </div>
                </div>
                <div class ="row">
                    <div class="col-3">
                        <label for="municipio">Municipio:</label>
                        <select name="municipio" class="form-control" id="municipio" style="text-transform: uppercase;" value="{{ old('municipio') }}">
                            <option value="" disabled>Seleccione un municipio</option>
                            <option value="Aconchi" {{ $afiliacion->municipio == 'Aconchi' ? 'selected' : '' }}>Aconchi</option>
                            <option value="Agua Prieta" {{ $afiliacion->municipio == 'Agua Prieta' ? 'selected' : '' }}>Agua Prieta</option>
                            <option value="Alamos" {{ $afiliacion->municipio == 'Alamos' ? 'selected' : '' }}>Álamos</option>
                            <option value="Altar" {{ $afiliacion->municipio == 'Altar' ? 'selected' : '' }}>Altar</option>
                            <option value="Arivechi" {{ $afiliacion->municipio == 'Arivechi' ? 'selected' : '' }}>Arivechi</option>
                            <option value="Bacadehuachi" {{ $afiliacion->municipio == 'Bacadehuachi' ? 'selected' : '' }}>Bacadéhuachi</option>
                            <option value="Bacanora" {{ $afiliacion->municipio == 'Bacanora' ? 'selected' : '' }}>Bacanora</option>
                            <option value="Bacerac" {{ $afiliacion->municipio == 'Bacerac' ? 'selected' : '' }}>Bacerac</option>
                            <option value="Bacoachi" {{ $afiliacion->municipio == 'Bacoachi' ? 'selected' : '' }}>Bacoachi</option>
                            <option value="Bácum" {{ $afiliacion->municipio == 'Bácum' ? 'selected' : '' }}>Bácum</option>
                            <option value="Banámichi" {{ $afiliacion->municipio == 'Banámichi' ? 'selected' : '' }}>Banámichi</option>
                            <option value="Baviácora" {{ $afiliacion->municipio == 'Baviácora' ? 'selected' : '' }}>Baviácora</option>
                            <option value="Bavispe" {{ $afiliacion->municipio == 'Bavispe' ? 'selected' : '' }}>Bavispe</option>
                            <option value="Benjamín Hill" {{ $afiliacion->municipio == 'Benjamín Hill' ? 'selected' : '' }}>Benjamín Hill</option>
                            <option value="Caborca" {{ $afiliacion->municipio == 'Caborca' ? 'selected' : '' }}>Caborca</option>
                            <option value="Cajeme" {{ $afiliacion->municipio == 'Cajeme' ? 'selected' : '' }}>Cajeme</option>
                            <option value="Cananea" {{ $afiliacion->municipio == 'Cananea' ? 'selected' : '' }}>Cananea</option>
                            <option value="Carbó" {{ $afiliacion->municipio == 'Carbó' ? 'selected' : '' }}>Carbó</option>
                            <option value="Cucurpe" {{ $afiliacion->municipio == 'Cucurpe' ? 'selected' : '' }}>Cucurpe</option>
                            <option value="Divisaderos" {{ $afiliacion->municipio == 'Divisaderos' ? 'selected' : '' }}>Divisaderos</option>
                            <option value="Empalme" {{ $afiliacion->municipio == 'Empalme' ? 'selected' : '' }}>Empalme</option>
                            <option value="Etchojoa" {{ $afiliacion->municipio == 'Etchojoa' ? 'selected' : '' }}>Etchojoa</option>
                            <option value="Fronteras" {{ $afiliacion->municipio == 'Fronteras' ? 'selected' : '' }}>Fronteras</option>
                            <option value="General Plutarco Elías Calles" {{ $afiliacion->municipio == 'General Plutarco Elías Calles' ? 'selected' : '' }}>General Plutarco Elías Calles</option>
                            <option value="Granados" {{ $afiliacion->municipio == 'Granados' ? 'selected' : '' }}>Granados</option>
                            <option value="Guaymas" {{ $afiliacion->municipio == 'Guaymas' ? 'selected' : '' }}>Guaymas</option>
                            <option value="Hermosillo" {{ $afiliacion->municipio == 'Hermosillo' ? 'selected' : '' }}>Hermosillo</option>
                            <option value="Huachinera" {{ $afiliacion->municipio == 'Huachinera' ? 'selected' : '' }}>Huachinera</option>
                            <option value="Huásabas" {{ $afiliacion->municipio == 'Huásabas' ? 'selected' : '' }}>Huásabas</option>
                            <option value="Huatabampo" {{ $afiliacion->municipio == 'Huatabampo' ? 'selected' : '' }}>Huatabampo</option>
                            <option value="Huépac" {{ $afiliacion->municipio == 'Huépac' ? 'selected' : '' }}>Huépac</option>
                            <option value="Imuris" {{ $afiliacion->municipio == 'Imuris' ? 'selected' : '' }}>Imuris</option>
                            <option value="La Colorada" {{ $afiliacion->municipio == 'La Colorada' ? 'selected' : '' }}>La Colorada</option>
                            <option value="Magdalena" {{ $afiliacion->municipio == 'Magdalena' ? 'selected' : '' }}>Magdalena</option>
                            <option value="Mazatán" {{ $afiliacion->municipio == 'Mazatán' ? 'selected' : '' }}>Mazatán</option>
                            <option value="Moctezuma" {{ $afiliacion->municipio == 'Moctezuma' ? 'selected' : '' }}>Moctezuma</option>
                            <option value="Naco" {{ $afiliacion->municipio == 'Naco' ? 'selected' : '' }}>Naco</option>
                            <option value="Nácori Chico" {{ $afiliacion->municipio == 'Nácori Chico' ? 'selected' : '' }}>Nácori Chico</option>
                            <option value="Nacozari de García" {{ $afiliacion->municipio == 'Nacozari de García' ? 'selected' : '' }}>Nacozari de García</option>
                            <option value="Navojoa" {{ $afiliacion->municipio == 'Navojoa' ? 'selected' : '' }}>Navojoa</option>
                            <option value="Nogales" {{ $afiliacion->municipio == 'Nogales' ? 'selected' : '' }}>Nogales</option>
                            <option value="Onavas" {{ $afiliacion->municipio == 'Onavas' ? 'selected' : '' }}>Onavas</option>
                            <option value="Opodepe" {{ $afiliacion->municipio == 'Opodepe' ? 'selected' : '' }}>Opodepe</option>
                            <option value="Oquitoa" {{ $afiliacion->municipio == 'Oquitoa' ? 'selected' : '' }}>Oquitoa</option>
                            <option value="Pitiquito" {{ $afiliacion->municipio == 'Pitiquito' ? 'selected' : '' }}>Pitiquito</option>
                            <option value="Puerto Peñasco" {{ $afiliacion->municipio == 'Puerto Peñasco' ? 'selected' : '' }}>Puerto Peñasco</option>
                            <option value="Quiriego" {{ $afiliacion->municipio == 'Quiriego' ? 'selected' : '' }}>Quiriego</option>
                            <option value="Rayón" {{ $afiliacion->municipio == 'Rayón' ? 'selected' : '' }}>Rayón</option>
                            <option value="Rosario" {{ $afiliacion->municipio == 'Rosario' ? 'selected' : '' }}>Rosario</option>
                            <option value="Sahuaripa" {{ $afiliacion->municipio == 'Sahuaripa' ? 'selected' : '' }}>Sahuaripa</option>
                            <option value="San Felipe de Jesús" {{ $afiliacion->municipio == 'San Felipe de Jesús' ? 'selected' : '' }}>San Felipe de Jesús</option>
                            <option value="San Ignacio Río Muerto" {{ $afiliacion->municipio == 'San Ignacio Río Muerto' ? 'selected' : '' }}>San Ignacio Río Muerto</option>
                            <option value="San Javier" {{ $afiliacion->municipio == 'San Javier' ? 'selected' : '' }}>San Javier</option>
                            <option value="San Luis Río Colorado" {{ $afiliacion->municipio == 'San Luis Río Colorado' ? 'selected' : '' }}>San Luis Río Colorado</option>
                            <option value="San Miguel de Horcasitas" {{ $afiliacion->municipio == 'San Miguel de Horcasitas' ? 'selected' : '' }}>San Miguel de Horcasitas</option>
                            <option value="San Pedro de la Cueva" {{ $afiliacion->municipio == 'San Pedro de la Cueva' ? 'selected' : '' }}>San Pedro de la Cueva</option>
                            <option value="Santa Ana" {{ $afiliacion->municipio == 'Santa Ana' ? 'selected' : '' }}>Santa Ana</option>
                            <option value="Santa Cruz" {{ $afiliacion->municipio == 'Santa Cruz' ? 'selected' : '' }}>Santa Cruz</option>
                            <option value="Sáric" {{ $afiliacion->municipio == 'Sáric' ? 'selected' : '' }}>Sáric</option>
                            <option value="Soyopa" {{ $afiliacion->municipio == 'Soyopa' ? 'selected' : '' }}>Soyopa</option>
                            <option value="Suaqui Grande" {{ $afiliacion->municipio == 'Suaqui Grande' ? 'selected' : '' }}>Suaqui Grande</option>
                            <option value="Tepache" {{ $afiliacion->municipio == 'Tepache' ? 'selected' : '' }}>Tepache</option>
                            <option value="Trincheras" {{ $afiliacion->municipio == 'Trincheras' ? 'selected' : '' }}>Trincheras</option>
                            <option value="Tubutama" {{ $afiliacion->municipio == 'Tubutama' ? 'selected' : '' }}>Tubutama</option>
                            <option value="Ures" {{ $afiliacion->municipio == 'Ures' ? 'selected' : '' }}>Ures</option>
                            <option value="Villa Hidalgo" {{ $afiliacion->municipio == 'Villa Hidalgo' ? 'selected' : '' }}>Villa Hidalgo</option>
                            <option value="Villa Pesqueira" {{ $afiliacion->municipio == 'Villa Pesqueira' ? 'selected' : '' }}>Villa Pesqueira</option>
                            <option value="Yécora" {{ $afiliacion->municipio == 'Yécora' ? 'selected' : '' }}>Yécora</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="calle">Calle:</label>
                        <input type="text" name="calle" class="form-control" id="calle" style="text-transform: uppercase;" value="{{ ($afiliacion->calle) }}">
                    </div>
                    <div class="col-1">
                        <label for="no_casa">No. casa:</label>
                        <input type="text" name="no_casa" class="form-control" id="no_casa" style="text-transform: uppercase;" value="{{ ($afiliacion->no_casa) }}" pattern="[0-9]+" title="Ingrese solo números">
                    </div>
                    <div class="col-3">
                        <label for="colonia">Colonia:</label>
                        <input type="text" name="colonia" class="form-control" id="colonia" style="text-transform: uppercase;" value="{{ ($afiliacion->colonia) }}">
                    </div>
                    <div class="col-2">
                        <label for="seccion">Seccion:</label>
                        <input type="text" name="seccion" class="form-control" id="seccion" style="text-transform: uppercase;" value="{{ ($afiliacion->seccion) }}">
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
                        <input type="text" name="placa" class="form-control" id="placa" style="text-transform: uppercase;" value="{{ ($afiliacion->placa) }}">
                    </div>
                    <div class="col-2">
                        <label for="modelo">Modelo:</label>
                        <input type="number" name="modelo" class="form-control" id="modelo" style="text-transform: uppercase;" value="{{ ($afiliacion->modelo) }}" pattern="[0-9]+" title="Ingrese solo números">
                    </div>
                    <div class="col-3">
                        <label for="marca">Marca:</label>
                        <input type="text" name="marca" class="form-control" id="marca" style="text-transform: uppercase;" value="{{ ($afiliacion->marca) }}">
                    </div>
                    <div class="col-3">
                        <label for="tipo">Tipo:</label>
                        <input type="text" name="tipo" class="form-control" id="tipo" style="text-transform: uppercase;"value="{{ ($afiliacion->tipo) }}">
                    </div>
                    <div class="col-2">
                        <label for="color">Color:</label>
                        <input type="text" name="color" class="form-control" id="color" style="text-transform: uppercase;"value="{{ ($afiliacion->color) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="serie">Serie:</label>
                        <input type="text" name="serie" class="form-control" id="serie" style="text-transform: uppercase;" value="{{ ($afiliacion->serie) }}"  minlength="17" maxlength="17">
                    </div>
                    <div class="col-6 align-self-end">
                        <p id="vehicle-info" style="display: none;">
                            <strong>Marca:</strong> <span id="vehicle-make">{{ $vehicleData['Results'][0]['Value'] ?? 'N/A' }}</span> |
                            <strong>Modelo:</strong> <span id="vehicle-model">{{ $vehicleData['Results'][1]['Value'] ?? 'N/A' }}</span> |
                            <strong>Año:</strong> <span id="vehicle-year">{{ $vehicleData['Results'][2]['Value'] ?? 'N/A' }}</span>
                        </p>
                    </div>
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
                <div class="row">
                    <div class="col-4">
                        <label for="metodo_pago">Metodo de pago</label>
                        <select name="metodo_pago" class="form-control" id="metodo_pago">
                            <option value="Efectivo" {{ $afiliacion->metodo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="Tarjeta" {{ $afiliacion->metodo_pago == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                            <option value="Transferencia" {{ $afiliacion->metodo_pago == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
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
                        <select name="tramito_seguro" class="form-control" id="tramito_seguro">
                            <option value="No" {{ $afiliacion->tramito_seguro == 'No' ? 'selected' : '' }}>No</option>
                            <option value="SI" {{ $afiliacion->tramito_seguro == 'SI' ? 'selected' : '' }}>Si</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="tipo_seguro">Tipo de seguro</label>
                        <select name="tipo_seguro" class="form-control" id="tipoSeguro">
                            <option value="Qualitas" {{ $afiliacion->tipo_seguro == 'Qualitas' ? 'selected' : '' }}>Qualitas $150,000</option>
                            <option value="Ana Seguros" {{ $afiliacion->tipo_seguro == 'Ana Seguros' ? 'selected' : '' }}>Ana Seguros $420,000</option>
                            <option value="Otro" {{ $afiliacion->tipo_seguro == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>                    
                    <div class="col-2">
                        <label for="no_poliza">No. Seguro:</label>
                        <input type="number" name="no_poliza" class="form-control" id="no_poliza" style="text-transform: uppercase;" value="{{ ($afiliacion->no_poliza) }}" title="Ingrese solo números">
                    </div>
                    <div class="col-6">
                        <label for="descripcion_seguro">Detalles:</label>
                        <input type="text" name="descripcion_seguro" class="form-control" id="descripcion_seguro" style="text-transform: uppercase;" value="{{ $afiliacion->descripcion_seguro }}">
                    </div>
                </div>
                <br>
                <div style="text-align: end">
                    <a href="/afiliaciones" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Actualizar Afiliacion</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        let conjuntoActual = 1;

        // Verifica si hay información en el Conjunto Dos y muestra automáticamente
        if (tieneInformacion("#conjunto-dos")) {
            $("#conjunto-dos").show();
            conjuntoActual = 2;
        }

        // Verifica si hay información en el Conjunto Tres y muestra automáticamente
        if (tieneInformacion("#conjunto-tres")) {
            $("#conjunto-tres").show();
            conjuntoActual = 3;
        }

        // Muestra el botón "Ocultar" si hay información en cualquier conjunto
        if (tieneInformacion("#conjunto-dos, #conjunto-tres")) {
            $("#ocultarCampos").show();
        }

        $("#mostrarCampos").click(function () {
            if (conjuntoActual === 1) {
                $("#conjunto-dos").show();
                conjuntoActual = 2;
            } else if (conjuntoActual === 2) {
                $("#conjunto-tres").show();
                conjuntoActual = 3;
            }

            // Muestra el botón "Ocultar" después de mostrar cualquier conjunto
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
                
                // Oculta el botón "Ocultar" si se oculta el Conjunto Dos
                $("#ocultarCampos").hide();
            }
        });

        function tieneInformacion(selector) {
            return $(selector + " input[type=text], " + selector + " input[type=number]").filter(function () { return $(this).val() !== ""; }).length > 0;
        }

        function limpiarCampos(selector) {
            $(selector + " input[type=text], " + selector + " input[type=number]").val('');
        }
    });


    $(document).ready(function(){
        $('#miFormulario').submit(function(event) {
            // Obtén el valor sin la máscara y quita caracteres no numéricos
            var celularSinMascara = $('#celular').inputmask('unmaskedvalue').replace(/\D/g, '');
            
            // Asigna el valor sin la máscara convertido a BigInt como cadena al campo antes de enviar el formulario
            $('#celular').val(celularSinMascara);

            // Continúa con el envío del formulario
        });
    });

    $(document).ready(function(){
        $('#celular').inputmask();
    });

</script>
<script>
    $(document).ready(function () {
        // Mostrar u ocultar campos según el valor inicial del campo 'seguro'
        if ($('#tramito_seguro').val() === 'SI') {
            $('#tipoSeguro').parent().show();
            toggleInsuranceFields();
        } else {
            $('#tipoSeguro').parent().hide();
            $('#no_poliza').parent().hide();
            $('#descripcion_seguro').parent().hide();
        }

        // Cambiar visibilidad de campos cuando se cambia el valor de 'seguro'
        $('#tramito_seguro').change(function () {
            if ($(this).val() === 'SI') {
                $('#tipoSeguro').parent().show();
                toggleInsuranceFields();
            } else {
                $('#tipoSeguro').parent().hide();
                $('#no_poliza').parent().hide();
                $('#descripcion_seguro').parent().hide();
                
                // Borrar los valores de los campos cuando se selecciona "No"
                $('#tipoSeguro').val('');
                $('#no_poliza').val('');
                $('#descripcion_seguro').val('');
            }
        });

        // Mostrar u ocultar campos en función del tipo de seguro seleccionado
        $('#tipoSeguro').change(function () {
            toggleInsuranceFields();
        });

        function toggleInsuranceFields() {
            const selectedTipoSeguro = $('#tipoSeguro').val();

            if (selectedTipoSeguro === 'Otro') {
                $('#descripcion_seguro').parent().show();
                $('#no_poliza').parent().hide();
            } else if (selectedTipoSeguro === 'Qualitas' || selectedTipoSeguro === 'Ana Seguros') {
                $('#no_poliza').parent().show();
                $('#descripcion_seguro').parent().hide();
            } else {
                $('#no_poliza').parent().hide();
                $('#descripcion_seguro').parent().hide();
            }
        }
    });
</script>


@endsection
