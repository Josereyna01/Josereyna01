@extends('layouts.app')

@section('content')
<style>
  td {
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
            <p style="font-size: 20px; color: #992323;margin-bottom:0">Listado de seguros.</p>
            <p style="color: #6f6f6f; margin-top:0">A continuación se muestra el listado de todos los Seguros registrados</p>
            <div class="row" style="text-align: end; margin-bottom: px">
                <form action="{{ route('afiliaciones.buscar') }}" method="get" class="row">
                    <div class="col-md-9">
                        <input type="text" name="busqueda" class="form-control" id="formGroupExampleInput" placeholder="Buscar Sucursal">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn" style="background-color:#1f4fa8; color: white; margin-right: 12px; width: 100%">Buscar</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('seguros.create') }}" class="btn btn-success" style="margin-right: 12px; width: 100%">Nuevo Seguro</a>
                    </div>
                </form>
            </div>

            <!-- Mostrar las afiliaciones con el valor 'SI' en 'tramito_seguro' -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Genero</th>
                        <th>Nombre</th>
                        <th>Vehiculo</th>
                        <th>Aseguradora</th>
                        <th>No. Poliza</th>
                        <th>Vencimiento</th>
                        <th>Fecha Expedición</th>
                        <th class="action-cell">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($afiliaciones as $afiliacion)
                        @if($afiliacion->tramito_seguro == "SI")
                            <tr>
                                <td>{{ $afiliacion->id }}</td>
                                <td>{{ $afiliacion->user->name }}</td>
                                <td>{{ $afiliacion->nombre_uno . ' ' . $afiliacion->ap_paterno_uno . ' ' . $afiliacion->ap_materno_uno }}</td>
                                <td>{{ $afiliacion->modelo . ' ' . $afiliacion->marca . ' ' . $afiliacion->tipo }}</td>
                                <td>{{ $afiliacion->tipo_seguro }}</td>
                                <td>{{ $afiliacion->no_poliza }}</td>
                                <td 
                                    style=  
                                    "@if($afiliacion->comprobante)
                                            color: green; /* Texto verde para 'Pagado' */
                                            background-color: transparent; /* Sin fondo */
                                        @else
                                            background-color: 
                                                @if($afiliacion->vencimiento >= 1 && $afiliacion->vencimiento <= 3)
                                                    rgba(0, 128, 0, 0.3);  <!-- Verde transparente para 1 a 3 -->
                                                @elseif($afiliacion->vencimiento >= 4 && $afiliacion->vencimiento <= 6)
                                                    rgba(255, 255, 0, 0.3);  <!-- Amarillo transparente para 4 a 6 -->
                                                @else
                                                    rgba(255, 0, 0, 0.3);  <!-- Rojo transparente para 7 en adelante -->
                                                @endif
                                        @endif">
                                    @if($afiliacion->comprobante)
                                        <strong>Pagado</strong>  <!-- Texto en negrita -->
                                    @else
                                        {{ $afiliacion->vencimiento }}
                                    @endif
                                </td>
                                <td>{{ $afiliacion->timestamp_tramito_seguro }}</td>
                                <td style="width: 10%">
                                    <a href="{{ route('seguros.pago', $afiliacion->id) }}" class="btn btn-sm btn-success">Pago</a>
                                    @if ($afiliacion->comprobante)
                                        <a href="{{ asset('storage/' . $afiliacion->comprobante) }}" class="btn btn-primary btn-sm" target="_blank">Ver</a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    <!-- Mostrar los seguros directamente de la tabla de seguros -->
                    @foreach($seguros as $seguro)
                        <tr>
                            <td>{{ $seguro->id }}</td>
                            <td>{{ $afiliacion->user->name }}</td>
                            <td>{{ $seguro->nombre_seguro . ' ' . $seguro->ap_paterno_seguro . ' ' . $seguro->ap_materno_seguro }}</td>
                            <td>{{ $seguro->modelo_seguro . ' ' . $seguro->marca_seguro . ' ' . $seguro->tipo_seguro }}</td>
                            <td>{{ $seguro->tipo_seguro_seguro }}</td>
                            <td>{{ $seguro->no_poliza_seguro }}</td>
                            <td 
                                style=  
                                "@if($seguro->comprobante)
                                        color: green; /* Texto verde para 'Pagado' */
                                        background-color: transparent; /* Sin fondo */
                                    @else
                                        background-color: 
                                            @if($afiliacion->vencimiento >= 1 && $afiliacion->vencimiento <= 3)
                                                rgba(0, 128, 0, 0.3);  <!-- Verde transparente para 1 a 3 -->
                                            @elseif($afiliacion->vencimiento >= 4 && $afiliacion->vencimiento <= 6)
                                                rgba(255, 255, 0, 0.3);  <!-- Amarillo transparente para 4 a 6 -->
                                            @else
                                                rgba(255, 0, 0, 0.3);  <!-- Rojo transparente para 7 en adelante -->
                                            @endif
                                    @endif">
                                @if($seguro->comprobante)
                                    <strong>Pagado</strong>  <!-- Texto en negrita -->
                                @else
                                    {{ $afiliacion->vencimiento }}
                                @endif
                            </td>
                            <td>{{ $seguro->timestamp_tramito_seguro_seguro }}</td>
                            <td style="width: 10%">
                                <a href="{{ route('seguros.edit', $seguro->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <a href="{{ route('seguros.pago', $seguro->id) }}" class="btn btn-sm btn-success">Pago</a>  
                                @if ($seguro->comprobante)
                                    <a href="{{ asset('storage/' . $seguro->comprobante) }}" class="btn btn-primary btn-sm" target="_blank">Ver</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
