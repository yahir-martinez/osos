@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Servicios</h1>

    <div class="card mb-4">
        <div class="card-header">
            {{ isset($servicioEdit) ? 'Editar Servicio' : 'Crear Servicio' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($servicioEdit) ? route('servicios.update', $servicioEdit) : route('servicios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($servicioEdit))
                    @method('PUT')
                @endif
                <div class="form-group mb-2">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $servicioEdit->nombre ?? '' }}" required>
                </div>
                <div class="form-group mb-2">
                    <label>Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control" value="{{ $servicioEdit->precio ?? '' }}" required>
                </div>
                <div class="form-group mb-2">
                    <label>Descripción</label>
                    <input type="text" name="descripcion" class="form-control" value="{{ $servicioEdit->descripcion ?? '' }}" required>
                </div>
                <div class="form-group mb-2">
                    <label>Imagen (Subir archivo)</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                    @if(isset($servicioEdit) && $servicioEdit->imagen)
                        <img src="{{ asset('storage/' . $servicioEdit->imagen) }}" alt="Imagen del servicio" class="mt-2" width="100">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary mt-2">{{ isset($servicioEdit) ? 'Actualizar' : 'Crear' }}</button>
                @if(isset($servicioEdit))
                    <a href="{{ route('servicios.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
                @endif
            </form>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th><th>Nombre</th><th>Precio</th><th>Descripción</th><th>Imagen</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
            <tr>
                <td>{{ $servicio->id }}</td>
                <td>{{ $servicio->nombre }}</td>
                <td>{{ $servicio->precio }}</td>
                <td>{{ $servicio->descripcion }}</td>
                <td>
                    {{ $servicio->imagen }}
                </td>
                <td>
                    <a href="{{ route('servicios.index', ['edit' => $servicio->id]) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline;">
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
