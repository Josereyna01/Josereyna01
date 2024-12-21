@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="row" style="margin:10px; margin-top:5px;">
    <p style="font-size: 20px; font-weight: bold; color: #6f6f6f; margin: 0px">
        <span class="material-symbols-outlined sub">edit</span>Editar Seguro
    </p>
    <div class="col-12" style="padding: 5px">
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <p style="font-size: 20px; color: #992323; margin-bottom:0">Formulario para editar el seguro.</p>
            <p style="color: #6f6f6f; margin-bottom:0">En este formulario puede editar los datos del seguro.</p><br>
            
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 0px; margin-bottom: 15px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('seguros.update', $seguro->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
                @method('PUT')
                {{-- --------------------------------------------------------------------------------------------------------------- --}}
                <div class="row" style="padding: 10px; margin-top: 15px; margin-bottom: 10px">
                    <div class="col-12" style="background-color:#618571; color: white; text-align: center; vertical-align: middle;">
                        <p style="margin: 0px; font-weight: bold">Seguro de Vehiculo</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="comprobante">Comprobante de Pago:</label>
                        <input type="file" name="comprobante" class="form-control" id="comprobante" style="text-transform: uppercase;" 
                            value="{{ old('comprobante', $afiliacion->comprobante) }}"
                            @if ($afiliacion->comprobante) readonly id="comprobanteFile" onclick="return confirmEdit()" @else id="comprobanteFile" @endif>
                        
                        @if ($afiliacion->comprobante)
                            <div class="mt-2" style="text-align: end">
                                <a href="{{ asset('storage/' . $afiliacion->comprobante) }}" class="btn btn-primary btn-sm" target="_blank">Ver Comprobante</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="seguroSelect">¿Tramito Seguro?</label>
                        <select name="tramito_seguro_seguro" class="form-control" id="seguroSelect" value="{{ old('tramito_seguro_seguro', $seguro->tramito_seguro_seguro) }}" disabled>
                            <option value="SI" {{ $seguro->tramito_seguro_seguro == 'SI' ? 'selected' : '' }}>Si</option>
                        </select>
                    </div>
                    <div class="col-2" id="tipoSeguroContainer" style="display: none;">
                        <label for="tipoSeguro">Tipo de seguro</label>
                        <select name="tipo_seguro_seguro" class="form-control" id="tipoSeguro">
                            <option value="" disabled selected>Selecciona un Seguro</option>
                            <option value="Qualitas" {{ $seguro->tipo_seguro_seguro == 'Qualitas' ? 'selected' : '' }}>Qualitas $150,000</option>
                            <option value="Ana Seguros" {{ $seguro->tipo_seguro_seguro == 'Ana Seguros' ? 'selected' : '' }}>Ana Seguros $420,000</option>
                            <option value="Otro" {{ $seguro->tipo_seguro_seguro == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    <div class="col-2" id="numeroSeguroContainer" style="display: none;">
                        <label for="no_poliza_seguro">No. Poliza:</label>
                        <input type="number" name="no_poliza_seguro" class="form-control" id="no_poliza_seguro" style="text-transform: uppercase;" value="{{ $seguro->no_poliza_seguro }}">
                    </div>
                    <div class="col-6" id="detallesSeguroContainer" style="display: none;">
                        <label for="descripcion_seguro_seguro">Detalles:</label>
                        <input type="text" name="descripcion_seguro_seguro" class="form-control" id="descripcion_seguro_seguro" style="text-transform: uppercase;" value="{{ $seguro->descripcion_seguro_seguro }}">
                    </div>
                </div>

                {{-- --------------------------------------------------------------------------------------------------------------- --}}
                <div class="row" style="padding: 10px; margin-top: 15px; margin-bottom: 10px">
                    <div class="col-12" style="background-color:#618571; color: white; text-align: center; vertical-align: middle;">
                        <p style="margin: 0px; font-weight: bold">Conductores</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="nombre_seguro">Nombre:</label>
                        <input type="text" name="nombre_seguro" class="form-control" value="{{ $seguro->nombre_seguro }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_paterno_seguro">Apellido Paterno:</label>
                        <input type="text" name="ap_paterno_seguro" class="form-control" value="{{ $seguro->ap_paterno_seguro }}">
                    </div>
                    <div class="col-3">
                        <label for="ap_materno_seguro">Apellido Materno:</label>
                        <input type="text" name="ap_materno_seguro" class="form-control" value="{{ $seguro->ap_materno_seguro }}">
                    </div>
                    <div class="col-3">
                        <label for="telefono_seguro">Telefono:</label>
                        <input type="number" name="telefono_seguro" class="form-control" value="{{ $seguro->telefono_seguro }}">
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
                        <label for="placa_seguro">Placas:</label>
                        <input type="text" name="placa_seguro" class="form-control" value="{{ $seguro->placa_seguro }}">
                    </div>
                    <div class="col-4">
                        <label for="modelo_seguro">Modelo:</label>
                        <input type="text" name="modelo_seguro" class="form-control" value="{{ $seguro->modelo_seguro }}">
                    </div>
                    <div class="col-3">
                        <label for="marca_seguro">Marca:</label>
                        <input type="text" name="marca_seguro" class="form-control" value="{{ $seguro->marca_seguro }}">
                    </div>
                    <div class="col-3">
                        <label for="tipo_seguro">Tipo:</label>
                        <input type="text" name="tipo_seguro" class="form-control" value="{{ $seguro->tipo_seguro }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="serie_seguro">Serie (VIN):</label>
                        <input type="text" name="serie_seguro" class="form-control" id="serie_seguro" style="text-transform: uppercase;" value="{{ $seguro->serie_seguro }}" minlength="17" maxlength="17">
                    </div>
                    <div class="col-6 align-self-end">
                        <p id="vehicle-info" style="display: none;">
                            <strong>Marca:</strong> <span id="vehicle-make">{{ $vehicleData['Results'][0]['Value'] ?? 'N/A' }}</span> |
                            <strong>Modelo:</strong> <span id="vehicle-model">{{ $vehicleData['Results'][1]['Value'] ?? 'N/A' }}</span> |
                            <strong>Año:</strong> <span id="vehicle-year">{{ $vehicleData['Results'][2]['Value'] ?? 'N/A' }}</span>
                        </p>
                    </div>
                </div>
                <br>
                <div style="text-align: end">
                    <a href="/seguros" class="btn btn-outline-secondary">Regresar</a>
                    <button type="submit" class="btn btn-success">Actualizar Seguro</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    // Función para mostrar el mensaje de confirmación si el usuario intenta editar el comprobante
    function confirmEdit() {
        if (confirm("El comprobante ya está cargado. ¿Deseas editarlo?")) {
            // Si el usuario confirma, habilitar el campo de archivo
            document.getElementById("comprobanteFile").removeAttribute("readonly");
            return true; // Permite seguir con el clic
        } else {
            // Si no confirma, no hace nada y mantiene el campo 'readonly'
            return false;
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("miFormulario").addEventListener("submit", function() {
            document.getElementById("btnCrear").setAttribute("disabled", "disabled");
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#serie_seguro').change(function () {
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
<script>
    $(document).ready(function () {
        // Mostrar u ocultar campos según el valor inicial del campo 'tramito_seguro'
        const tramitoSeguroValue = $('#seguroSelect').val();  // Recupera el valor inicial de tramito_seguro

        // Si el valor es "SI", mostrar los campos relacionados
        if (tramitoSeguroValue === 'SI') {
            $('#tipoSeguroContainer').show();  // Muestra el campo Tipo de Seguro
            toggleInsuranceFields();  // Llama a la función que maneja la visibilidad de los campos de seguro
        } else {
            $('#tipoSeguroContainer').hide();  // Oculta el campo Tipo de Seguro
            $('#numeroSeguroContainer').hide();  // Oculta el campo No. Poliza
            $('#detallesSeguroContainer').hide();  // Oculta el campo Detalles
        }

        // Cambiar visibilidad de campos cuando se cambia el valor de 'tramito_seguro'
        $('#seguroSelect').change(function () {
            if ($(this).val() === 'SI') {
                $('#tipoSeguroContainer').show();
                toggleInsuranceFields();
            } else {
                $('#tipoSeguroContainer').hide();
                $('#numeroSeguroContainer').hide();
                $('#detallesSeguroContainer').hide();
                
                // Borrar los valores de los campos cuando se selecciona "No"
                $('#tipoSeguro').val('');
                $('#no_poliza_seguro').val('');
                $('#descripcion_seguro_seguro').val('');
            }
        });

        // Mostrar u ocultar campos en función del tipo de seguro seleccionado
        $('#tipoSeguro').change(function () {
            toggleInsuranceFields();
        });

        function toggleInsuranceFields() {
            const selectedTipoSeguro = $('#tipoSeguro').val();

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
        }
    });
</script>

@endsection
