
@extends('layouts.app')
@section('content')
<style>
  td{
    text-transform: uppercase;
  }

  .pagination > li > a {
        color: #a43227 !important;
    }

    /* Cambiar el color de fondo y el color del texto para el enlace activo */
    .pagination > li.active > a,
    .pagination > li.active > a:focus,
    .pagination > li.active > a:hover {
        background-color: #a43227 !important;
        border-color: #a43227 !important;
        color: white !important;
    }
    
    /* Cambiar el color de fondo de los enlaces al pasar el mouse (hover) */
    .pagination > li > a:hover {
        background-color: #a43227 !important;
        color: white !important; 
    }
</style>
<div class="row" style="margin:10px; margin-top:5px;">
    <p style="font-size: 20px; font-weight: bold; color: #6f6f6f; margin: 0px"><span class="material-symbols-outlined sub">home_health</span>Afiliaciones</p>
    <div class="col-12" style="padding: 5px">
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <p style="font-size: 20px; color: #992323;margin-bottom:0">Listado de Afiliaciones.</p>
            <p style="color: #6f6f6f; margin-top:0">A continuación se muestra el listado de todas las afiliaciones registradas</p>
            <div class="row" style="text-align: end; margin-bottom: px">
                <form action="{{ route('afiliaciones.buscar') }}" method="get" class="row">
                    <div class="col-md-9">
                        <input type="text" name="busqueda" class="form-control" id="formGroupExampleInput" placeholder="Buscar Sucursal">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn" style="background-color:#1f4fa8; color: white; margin-right: 12px; width: 100%">Buscar</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('afiliaciones.create') }}" class="btn btn-success" style="margin-right: 12px; width: 100%">Nueva Afiliacion</a>
                    </div>
                </form>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Genero</th>
                        <th>Nombre</th>
                        <th>No. Teléfono</th>
                        <th>Placa</th>
                        <th>Descripcion</th>
                        <th>Serie</th>
                        <th>Seguro</th>
                        <th>Fecha</th>
                        <th class="action-cell">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($afiliaciones as $afiliacion)
                    <tr>
                        <td>{{ $afiliacion->id }}</td>
                        <td>{{ $afiliacion->user->name }}</td>
                        <td>{{ $afiliacion->nombre_uno . ' ' . $afiliacion->ap_paterno_uno . ' ' . $afiliacion->ap_materno_uno }}</td>
                        <td>{{ $afiliacion->tel_uno }}</td>
                        <td>{{ $afiliacion->placa }}</td>
                        <td>{{ $afiliacion->modelo . ' ' . $afiliacion->marca . ' ' . $afiliacion->tipo }}</td>
                        <td>{{ $afiliacion->serie }}</td>
                        <td>{{ $afiliacion->tipo_seguro }}</td>
                        <td>{{ $afiliacion->created_at }}</td>
                        <td class="action-cell">
                        @if($afiliacion->tramito_seguro == "SI")
                            <a href="{{ route('afiliaciones.pdf_seguro', ['id' => $afiliacion->id]) }}" target="_blank" class="btn btn-sm btn-primary">
                                <span class="material-icons">Pago Seguro</span>
                            </a>
                        @endif
                            <a href="{{ route('afiliaciones.pdf', ['id' => $afiliacion->id]) }}" target="_blank" class="btn btn-sm btn-success">
                                <span class="material-icons">Imprimir</span>
                            </a>
                            <a href="{{ route('afiliaciones.edit', $afiliacion->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $afiliaciones->links() }}
        </div>
    </div>
</div>
@endsection