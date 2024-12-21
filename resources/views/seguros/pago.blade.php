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

            @if (isset($afiliacion))
                <form action="{{ route('seguros.updatePago', $afiliacion->id) }}" method="POST" enctype="multipart/form-data">
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
                            <select name="tramito_seguro_seguro" class="form-control" id="seguroSelect" value="{{ old('tramito_seguro_seguro', $afiliacion->tramito_seguro_seguro) }}" disabled>
                                <option value="SI" {{ $afiliacion->tramito_seguro_seguro == 'SI' ? 'selected' : '' }}>Si</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <label for="tipoSeguro">Tipo de seguro</label>
                            <select name="tipo_seguro_seguro" class="form-control" disabled id="tipoSeguro">
                                <option value="Qualitas" {{ $afiliacion->tipo_seguro == 'Qualitas' ? 'selected' : '' }}>Qualitas $150,000</option>
                                <option value="Ana Seguros" {{ $afiliacion->tipo_seguro == 'Ana Seguros' ? 'selected' : '' }}>Ana Seguros $420,000</option>
                                <option value="Otro" {{ $afiliacion->tipo_seguro == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <label for="no_poliza">No. Poliza:</label>
                            <input type="number" name="no_poliza" class="form-control" id="no_poliza" style="text-transform: uppercase;" value="{{ $afiliacion->no_poliza }}" readonly>
                        </div>
                        <div class="col-6">
                            <label for="descripcion_seguro">Detalles:</label>
                            <input type="text" name="descripcion_seguro" class="form-control" id="descripcion_seguro" style="text-transform: uppercase;" value="{{ $afiliacion->descripcion_seguro }}" readonly>
                        </div>
                    </div>
                    <br>
                    <div style="text-align: end">
                        <a href="/seguros" class="btn btn-outline-secondary">Regresar</a>
                        <button type="submit" class="btn btn-success">Actualizar Seguro</button>
                    </div>
                </form>

            @elseif (isset($seguro))
                <form action="{{ route('seguros.updatePago', $seguro->id) }}" method="POST" enctype="multipart/form-data">
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
                                value="{{ old('comprobante', $seguro->comprobante) }}"
                                @if ($seguro->comprobante) readonly id="comprobanteFile" onclick="return confirmEdit()" @else id="comprobanteFile" @endif>
                            
                            @if ($seguro->comprobante)
                                <div class="mt-2" style="text-align: end">
                                    <a href="{{ asset('storage/' . $seguro->comprobante) }}" class="btn btn-primary btn-sm" target="_blank">Ver Comprobante</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-2">
                            <label for="seguroSelect">¿Tramito Seguro?</label>
                            <select name="tramito_seguro" class="form-control" id="seguroSelect" value="{{ old('tramito_seguro', $seguro->tramito_seguro) }}" disabled>
                                <option value="SI" {{ $seguro->tramito_seguro == 'SI' ? 'selected' : '' }}>Si</option>
                            </select>
                        </div>
                        <div class="col-2" id="tipoSeguroContainer" style="display: none;">
                            <label for="tipoSeguro">Tipo de seguro</label>
                            <select name="tipo_seguro" class="form-control" id="tipoSeguro">
                                <option value="" disabled selected>Selecciona un Seguro</option>
                                <option value="Qualitas" {{ $seguro->tipo_seguro == 'Qualitas' ? 'selected' : '' }}>Qualitas $150,000</option>
                                <option value="Ana Seguros" {{ $seguro->tipo_seguro == 'Ana Seguros' ? 'selected' : '' }}>Ana Seguros $420,000</option>
                                <option value="Otro" {{ $seguro->tipo_seguro == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        <div class="col-2" id="numeroSeguroContainer" style="display: none;">
                            <label for="no_poliza">No. Poliza:</label>
                            <input type="number" name="no_poliza" class="form-control" id="no_poliza" style="text-transform: uppercase;" value="{{ $seguro->no_poliza }}" readonly>
                        </div>
                        <div class="col-6" id="detallesSeguroContainer" style="display: none;">
                            <label for="descripcion_seguro">Detalles:</label>
                            <input type="text" name="descripcion_seguro" class="form-control" id="descripcion_seguro" style="text-transform: uppercase;" value="{{ $seguro->descripcion_seguro }}" readonly>
                        </div>
                    </div>

                    <br>
                    <div style="text-align: end">
                        <a href="/seguros" class="btn btn-outline-secondary">Regresar</a>
                        <button type="submit" class="btn btn-success">Actualizar Seguro</button>
                    </div>
                </form>

            @else
                <p>No se encontró el seguro o la afiliación.</p>
            @endif
        </div>
    </div>
</div>

<script>
    function confirmEdit() {
        if (confirm("El comprobante ya está cargado. ¿Deseas editarlo?")) {
            document.getElementById("comprobanteFile").removeAttribute("readonly");
            return true;
        } else {
            return false;
        }
    }
</script>

<script>
    $(document).ready(function () {
        const tramitoSeguroValue = $('#seguroSelect').val();
        
        if (tramitoSeguroValue === 'SI') {
            $('#tipoSeguroContainer').show();
            toggleInsuranceFields();
        } else {
            $('#tipoSeguroContainer').hide();
        }

        $('#seguroSelect').change(function () {
            if ($(this).val() === 'SI') {
                $('#tipoSeguroContainer').show();
                toggleInsuranceFields();
            } else {
                $('#tipoSeguroContainer').hide();
                $('#tipoSeguro').val('');
            }
        });

        $('#tipoSeguro').change(function () {
            toggleInsuranceFields();
        });

        function toggleInsuranceFields() {
            const selectedTipoSeguro = $('#tipoSeguro').val();

            if (selectedTipoSeguro === 'Otro') {
                $('#detallesSeguroContainer').show();
            } else {
                $('#detallesSeguroContainer').hide();
            }
        }
    });
</script>

@endsection
