<!-- resources/views/afiliaciones/decode-vin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decodificar VIN</title>
</head>
<body>
    <h1>Decodificar VIN</h1>
    <form method="GET" action="{{ route('decode-vin') }}">
        <label for="vin">Ingrese el VIN del vehículo:</label>
        <input type="text" id="vin" name="vin" required minlength="17" maxlength="17">
        <button type="submit">Decodificar</button>
    </form>

    @if (session('response'))
        <h2>Información del Vehículo</h2>
        <pre>{{ json_encode(session('response'), JSON_PRETTY_PRINT) }}</pre>
    @endif
</body>
</html>
