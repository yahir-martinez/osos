@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Eventos</h1>

    {{-- FORMULARIO DE CREAR / EDITAR --}}
    <div class="card mb-4">
        <div class="card-header">
            {{ isset($eventoEdit) ? 'Editar Evento' : 'Crear Evento' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($eventoEdit) ? route('eventos.update', $eventoEdit) : route('eventos.store') }}" method="POST">
                @csrf
                @if(isset($eventoEdit))
                    @method('PUT')
                @endif
                <div class="form-group mb-2">
                    <label>Servicio</label>
                    <select name="servicio_id" class="form-control" required>
                        @foreach ($servicios as $servicio)
                            <option value="{{ $servicio->id }}" {{ (isset($eventoEdit) && $eventoEdit->servicio_id == $servicio->id) ? 'selected' : '' }}>{{ $servicio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label>Precio Final</label>
                    <input type="number" step="0.01" name="precio_final" class="form-control" value="{{ $eventoEdit->precio_final ?? '' }}" required>
                </div>
                <div class="form-group mb-2">
                    <label>Ubicación</label>
                    <input type="text" name="ubicacion" class="form-control" value="{{ $eventoEdit->ubicacion ?? '' }}" required>
                </div>
                <div class="form-group mb-2">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ $eventoEdit->fecha ?? '' }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">{{ isset($eventoEdit) ? 'Actualizar' : 'Crear' }}</button>
                @if(isset($eventoEdit))
                    <a href="{{ route('eventos.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
                @endif
            </form>
        </div>
    </div>

    {{-- LISTADO --}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th><th>Servicio</th><th>Precio Final</th><th>Ubicación</th><th>Fecha</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventos as $evento)
            <tr>
                <td>{{ $evento->id }}</td>
                <td>{{ $evento->servicio->nombre }}</td>
                <td>{{ $evento->precio_final }}</td>
                <td>{{ $evento->ubicacion }}</td>
                <td>{{ $evento->fecha }}</td>
                <td>
                    <a href="{{ route('eventos.index', ['edit' => $evento->id]) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('eventos.destroy', $evento) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
