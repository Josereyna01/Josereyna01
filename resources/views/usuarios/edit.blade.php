@extends('layouts.app')

@section('content')
<!-- Agrega esto en la sección head de tu HTML -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/Inputmask/5.x/dist/jquery.inputmask.min.js"></script>

<div class="row" style="margin: 10px; margin-top: 5px;">
    <!-- Formulario para edición de cliente existente -->
    <p class="icon-text">
        <span class="material-symbols-outlined sub">edit</span>
        Editar Producto
    </p>
    <div class="col-12" style="padding: 5px;">
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <p style="font-size: 20px; color: #125e2b; margin-bottom: 0;">Formulario para edición de producto existente.</p>
            </div>
            <p style="color: #6f6f6f; margin-bottom: 0;">En el siguiente formulario, puede editar los datos del producto.</p><br>
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 0; margin-bottom: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT') 
                <div class="row">
                    <div class="col-4">
                        <label for="name">Nombres:</label>
                        <input type="text" name="name" class="form-control" id="name" style="text-transform: uppercase;" value="{{ $user->name }}">
                    </div>
                    <div class="col">
                        <label for="apellido_paterno">Apellido Paterno:</label>
                        <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" style="text-transform: uppercase;" value="{{ $user->apellido_paterno }}">
                    </div>
                    <div class="col-4">
                        <label for="apellido_materno">Apellido Materno:</label>
                        <input type="text" name="apellido_materno" class="form-control" id="apellido_materno" style="text-transform: uppercase;" value="{{ $user->apellido_materno }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="email">Correo:</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                    </div>
                    <div class="col-4">
                        <label for="celular">Celular:</label>
                        <input type="text" name="celular" class="form-control" id="celular" data-inputmask="'mask': '(999) 999-9999'" value="{{ $user->celular }}">
                    </div>
                    <div class="col-4">
                        <label for="sucursal">Sucursal:</label>
                        <select name="sucursal" class="form-control" id="sucursal" style="text-transform:uppercase">
                            @foreach($sucursales as $sucursal)
                            <option value="{{ $sucursal->nombre }}" {{ $user->sucursal == $sucursal->nombre ? 'selected' : '' }}>
                                {{ $sucursal->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="estatus">Estatus:</label>
                        <select name="estatus" class="form-control" id="estatus">
                            <option value="Activo" {{ $user->estatus == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $user->estatus == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="rol">Rol:</label>
                        <select name="rol" class="form-control" id="rol" style="text-transform: uppercase">
                            @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div> 
                </div>
                <br>
                <div style="text-align: end">
                    <a href="/usuarios" class="btn btn-outline-secondary">Regresar</a>
                    <button type="submit" class="btn btn-success">Actualizar Usuario</button>
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


