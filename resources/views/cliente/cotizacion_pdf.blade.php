<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización de Evento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        .container {
            margin-top: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 8px 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .table th {
            background-color: #f8f8f8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cotización del Evento</h1>

        <p><strong>Servicio:</strong> {{ $servicio->nombre ?? 'No definido' }}</p>
        <p><strong>Ubicación:</strong> {{ $evento->ubicacion ?? 'No definida' }}</p>
        <p><strong>Fecha del Evento:</strong> {{ $evento->fecha ?? 'No definida' }}</p>
        <p><strong>Precio Final:</strong> ${{ $precioFinal ?? '0.00' }}</p>

        <h3>Detalles del Evento</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $evento->id ?? 'N/A' }}</td>
                    <td>{{ $servicio->nombre ?? 'Desconocido' }}</td>
                    <td>${{ $precioFinal ?? '0.00' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
