@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Cotizar Evento</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de cotización -->
    <form action="{{ route('cliente.cotizar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Servicio</label>
            <select name="servicio_id" class="form-control" required id="servicioSelect">
                @foreach ($servicios as $servicio)
                    <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">
                        {{ $servicio->nombre }} - ${{ $servicio->precio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Ubicación del evento</label>
            <input type="text" name="ubicacion" class="form-control" required placeholder="Dirección completa">
        </div>

        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Cantidad de personas</label>
            <input type="number" name="personas" id="personasInput" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label>Precio estimado</label>
            <input type="text" id="precioCalculado" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cotización</button>
    </form>
</div>

<script>
    // Obtener elementos del formulario
    const servicioSelect = document.getElementById('servicioSelect');
    const personasInput = document.getElementById('personasInput');
    const precioCalculado = document.getElementById('precioCalculado');

    // Función para calcular el precio
    function calcularPrecio() {
        const servicioPrecio = servicioSelect.options[servicioSelect.selectedIndex]?.getAttribute('data-precio');
        const personas = personasInput.value;
        if (servicioPrecio && personas) {
            // Calcular precio final
            precioCalculado.value = '$' + (servicioPrecio * personas);
        } else {
            // Si no hay valor, vaciar el campo de precio
            precioCalculado.value = '';
        }
    }

    // Agregar eventos para calcular el precio al seleccionar un servicio o poner la cantidad de personas
    servicioSelect.addEventListener('change', calcularPrecio);
    personasInput.addEventListener('input', calcularPrecio);
</script>
@endsection
