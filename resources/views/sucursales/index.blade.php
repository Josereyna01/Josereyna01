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
    <p style="font-size: 20px; font-weight: bold; color: #6f6f6f; margin: 0px"><span class="material-symbols-outlined sub">home_health</span>Sucursales</p>
    <div class="col-12" style="padding: 5px">
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <p style="font-size: 20px; color: #992323;margin-bottom:0">Listado de Sucursales.</p>
            <p style="color: #6f6f6f; margin-top:0">A continuación se muestra el listado de todas las sucursales registradas</p><br>
            <div class="row" style="text-align: end; margin-bottom: 10px">
                <form action="{{ route('sucursales.buscar') }}" method="get" class="row">
                    <div class="col-md-9">
                        <input type="text" name="busqueda" class="form-control" id="formGroupExampleInput" placeholder="Buscar Sucursal">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn" style="background-color:#1f4fa8; color: white; margin-right: 12px; width: 100%">Buscar</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('sucursales.create') }}" class="btn btn-success" style="margin-right: 12px; width: 100%">Nueva Sucursal</a>
                    </div>
                </form>
            </div>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col" style="color:#992323">ID</th>
                    <th scope="col" style="color:#992323">Nombre de la Sucursal</th>
                    <th scope="col" style="color:#992323">Direccion</th>
                    <th scope="col" style="color:#992323">Tipo</th>
                    <th scope="col" style="color:#992323">Estatus</th>
                    <th scope="col" style="color:#992323">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($sucursales as $sucursal)
                      <tr>
                          <th scope="row">{{ $sucursal->id }}</th>
                          <td>{{ $sucursal->nombre }}</td>
                          <td>{{ $sucursal->direccion }}</td>
                          <td>{{ $sucursal->tipo_sucursal }}</td>
                          <td>{{ $sucursal->estatus }}</td>
                          <td style="width: 10%">
                            <a href="{{ route('sucursales.edit', $sucursal->id) }}" style="text-transform: capitalize" class="btn btn-sm btn-warning">Editar Sucursal</a>
                          </td>                        
                      </tr>
                  @endforeach
              </tbody>
            </table>
            {{ $sucursales->links() }}
        </div>
    </div>
</div>
@endsection