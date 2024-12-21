@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Figtree', sans-serif;
        color: #5D5D5D;
        margin-top: 0px;
    }
    .confirmation-box {
        max-width: 600px;
        margin: 50px auto; /* Agregamos un margen superior para separarlo del navbar */
        text-align: center;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }
    .confirmation-box h1 {
        color: #333;
    }
    .confirmation-box p {
        color: #555;
    }
    .additional-info {
        background-color: #f5f5f5;
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px;
    }
    .additional-info p {
        color: #777;
        margin: 5px 0;
    }
    .additional-info ul {
        list-style: none;
        padding: 0;
    }
    .additional-info li {
        margin-bottom: 5px;
    }
    .pdf-link {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }
    .back-link {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #28a745;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        margin-left: 10px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="confirmation-box">
                <h1>Afiliación creada con éxito</h1>
                <p>Gracias por completar la afiliación.</p>

                <!-- Información adicional -->
                <div class="additional-info">
                    <p>Recuerde solicitar al cliente:</p>
                    <ul>
                        <li>2 copias de la identificación (INE o Licencia)</li>
                        <li>2 copias del título</li>
                    </ul>
                </div>

                <!-- Enlace para ver el PDF -->
                <a href="{{  route('afiliaciones.pdf', ['id' => $afiliacion->id]) }}" target="_blank" class="pdf-link">Ver PDF</a>

                <!-- Enlace para regresar -->
                <a href="{{ route('afiliaciones.index') }}" class="back-link">Regresar</a>
            </div>
        </div>
    </div>
</div>
@endsection
