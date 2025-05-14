@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menús</h1>

    <div class="card mb-4">
        <div class="card-header">
            {{ isset($menuEdit) ? 'Editar Menú' : 'Crear Menú' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($menuEdit) ? route('menus.update', $menuEdit) : route('menus.store') }}" method="POST">
                @csrf
                @if(isset($menuEdit))
                    @method('PUT')
                @endif
                <div class="form-group mb-2">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $menuEdit->nombre ?? '' }}" required>
                </div>
                <div class="form-group mb-2">
                    <label>Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control" value="{{ $menuEdit->precio ?? '' }}" required>
                </div>
                <div class="form-group mb-2">
                    <label>Descripción</label>
                    <input type="text" name="descripcion" class="form-control" value="{{ $menuEdit->descripcion ?? '' }}" required>
                </div>
                <div class="form-group mb-2">
                    <label>Imagen (URL)</label>
                    <input type="text" name="imagen" class="form-control" value="{{ $menuEdit->imagen ?? '' }}">
                </div>
                <button type="submit" class="btn btn-primary mt-2">{{ isset($menuEdit) ? 'Actualizar' : 'Crear' }}</button>
                @if(isset($menuEdit))
                    <a href="{{ route('menus.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
                @endif
            </form>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th><th>Nombre</th><th>Precio</th><th>Descripción</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->nombre }}</td>
                <td>{{ $menu->precio }}</td>
                <td>{{ $menu->descripcion }}</td>
                <td>
                    <a href="{{ route('menus.index', ['edit' => $menu->id]) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline;">
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
