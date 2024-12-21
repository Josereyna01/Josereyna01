@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="row" style="margin:10px; margin-top:5px;">
    <p style="font-size: 20px; font-weight: bold; color: #6f6f6f; margin: 0px">
        <span class="material-symbols-outlined sub">add_circle</span>Nuevo Seguro
    </p>
    <div class="col-12" style="padding: 5px">
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <p style="font-size: 20px; color: #992323; margin-bottom:0">Formulario para crear un nuevo seguro.</p>
            <p style="color: #6f6f6f; margin-bottom:0">En este formulario puedes agregar los datos de un nuevo seguro.</p><br>
            
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 0px; margin-bottom: 15px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('seguros.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row" style="padding: 10px; margin-top: 15px; margin-bottom: 10px">
                    <div class="col-12" style="background-color:#618571; color: white; text-align: center; vertical-align: middle;">
                        <p style="margin: 0px; font-weight: bold">Seguro de Vehiculo</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="tramito_seguro_seguro">¿Tramito Seguro?</label>
                        <select name="tramito_seguro_seguro" class="form-control" id="seguroSelect" value="{{ old('tramito_seguro_seguro') }}">
                            <option value="No">No</option>
                            <option value="SI">Si</option>
                        </select>
                    </div>
                    <div class="col-2" id="tipoSeguroContainer" style="display: none;">
                        <label for="tipo_seguro_seguro">Tipo de seguro</label>
                        <select name="tipo_seguro_seguro" class="form-control" id="tipoSeguro" value="{{ old('tipo_seguro_seguro') }}">
                            <option>Selecciona un Seguro</option disabled>
                            <option value="Qualitas">Qualitas $150,000</option>
                            <option value="Ana Seguros">Ana Seguros $420,000</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-2" id="numeroSeguroContainer" style="display: none;">
                        <label for="no_poliza_seguro">No. Poliza:</label>
                        <input type="number" name="no_poliza_seguro" class="form-control" id="no_poliza_seguro" style="text-transform: uppercase;" value="{{ old('no_poliza_seguro') }}">
                    </div>
                    <div class="col-6" id="detallesSeguroContainer" style="display: none;">
                        <label for="descripcion_seguro_seguro">Detalles:</label>
                        <input type="text" name="descripcion_seguro_seguro" class="form-control" id="descripcion_seguro_seguro" style="text-transform: uppercase;" value="{{ old('descripcion_seguro_seguro') }}">
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
                        <input type="text" name="nombre_seguro" class="form-control" value="{{ old('nombre_seguro') }}" required>
                    </div>
                    <div class="col-3">
                        <label for="ap_paterno_seguro">Apellido Paterno:</label>
                        <input type="text" name="ap_paterno_seguro" class="form-control" value="{{ old('ap_paterno_seguro') }}" required>
                    </div>
                    <div class="col-3">
                        <label for="ap_materno_seguro">Apellido Materno:</label>
                        <input type="text" name="ap_materno_seguro" class="form-control" value="{{ old('ap_materno_seguro') }}" required>
                    </div>
                    <div class="col-3">
                        <label for="telefono_seguro">Telefono:</label>
                        <input type="number" name="telefono_seguro" class="form-control" value="{{ old('telefono_seguro') }}" required>
                    </div>
                </div>
                {{-- --------------------------------------------------------------------------------------------------------------- --}}
                <div class="row" style="padding: 10px; margin-top: 15px; margin-bottom: 10px">
                    <div class="col-12" style="background-color:#618571; color: white; text-align: center; vertical-align: middle;">
                        <p style="margin: 0px; font-weight: bold">Datos del Vehiculo</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="placa_seguro">Numero de Placa:</label>
                        <input type="text" name="placa_seguro" class="form-control" id="placa_seguro" style="text-transform: uppercase;" value="{{ old('placa_seguro') }}">
                    </div>
                    <div class="col-3">
                        <label for="modelo_seguro">Modelo:</label>
                        <input type="number" name="modelo_seguro" class="form-control" id="modelo_seguro" style="text-transform: uppercase;" value="{{ old('modelo_seguro') }}" pattern="[0-9]+" title="Ingrese solo números">
                    </div>
                    <div class="col-3">
                        <label for="marca_seguro">Marca:</label>
                        <input type="text" name="marca_seguro" class="form-control" id="marca_seguro" style="text-transform: uppercase;" value="{{ old('marca_seguro') }}">
                    </div>
                    <div class="col-3">
                        <label for="tipo_seguro">Tipo:</label>
                        <input type="text" name="tipo_seguro" class="form-control" id="tipo_seguro" style="text-transform: uppercase;" value="{{ old('tipo_seguro') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="serie_seguro">Serie (VIN):</label>
                        <input type="text" name="serie_seguro" class="form-control" id="serie_seguro" style="text-transform: uppercase;" value="{{ old('serie_seguro') }}" minlength="17" maxlength="17">
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
                    <button type="submit" class="btn btn-success">Crear Seguro</button>
                </div>
            </form>

        </div>
    </div>
</div>
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
        $('#no_poliza_seguro').val('');
        $('#descripcion_seguro_seguro').val('');
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
@endsection
