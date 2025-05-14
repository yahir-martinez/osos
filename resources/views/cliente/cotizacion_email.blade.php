<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotización de tu Evento</title>
</head>
<body>
    <h2>¡Hola {{ $evento->usuario->name }}!</h2>
    <p>Gracias por cotizar con nosotros.</p>
    <p>Adjunto te enviamos la cotización de tu evento <strong>"{{ $servicio->nombre }}"</strong>, que se llevará a cabo el día <strong>{{ $evento->fecha }}</strong> en <strong>{{ $evento->ubicacion }}</strong>.</p>
    <p>El precio estimado por <strong>{{ $personas }}</strong> personas es de <strong>${{ number_format($precioFinal, 2) }}</strong>.</p>

    <p>Revisa el PDF adjunto para ver todos los detalles.</p>

    <p>Atentamente,<br>
    El equipo de Cotizaciones</p>
</body>
</html>
