@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="row" style="margin:10px; margin-top:5px;">
    <p style="font-size: 20px; font-weight: bold; color: #6f6f6f; margin: 0px"><span class="material-symbols-outlined sub">edit</span>Editar Sucursal</p>
    <div class="col-12" style="padding: 5px">
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <p style="font-size: 20px; color: #992323;margin-bottom:0">Formulario para edición de la sucursal.</p>
            <p style="color: #6f6f6f; margin-top:0">Modifique los datos que desee y pulse guardar.</p><br>
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 0px; margin-bottom: 15px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('sucursales.update', $sucursal->id) }}" method="POST">
                @csrf
                @method('PUT') 
                <div class="row">
                    <div class="col-4">
                        <label for="nombre">Nombre de la sucursal:</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $sucursal->nombre }}" style="text-transform: uppercase;">
                    </div>
                    <div class="col-4">
                        <label for="direccion">Direccion:</label>
                        <input type="text" name="direccion" class="form-control" id="direccion" value="{{ $sucursal->direccion }}" style="text-transform: uppercase;">
                    </div>
                    <div class="col-2">
                        <label for="tipo_sucursal">Tipo de sucursal:</label>
                        <select name="tipo_sucursal" class="form-control" id="tipo_sucursal">
                            <option value="Movil" {{ $sucursal->tipo_sucursal == 'Movil' ? 'selected' : '' }}>Movil</option>
                            <option value="Fijo" {{ $sucursal->tipo_sucursal == 'Fijo' ? 'selected' : '' }}>Fijo</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="estatus">Estatus:</label>
                        <select name="estatus" class="form-control" id="estatus">
                            <option value="Activo" {{ $sucursal->estatus == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $sucursal->estatus == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="celular">Celular:</label>
                        <input type="text" name="celular" class="form-control" id="celular" data-inputmask="'mask': '(999) 999-9999'" value="{{ $sucursal->celular }}">
                    </div>
                    <div class="col-10">
                        <label for="comentarios">Comentarios:</label>
                        <input type="text" name="comentarios" class="form-control" id="comentarios" value="{{ $sucursal->comentarios }}" style="text-transform: uppercase;">
                    </div>
                </div>
                <br>
                <div style="text-align: end">
                    <a href="/sucursales" class="btn btn-outline-secondary">Regresar</a>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
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
@endsection
