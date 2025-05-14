@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Usuarios</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORMULARIO DE CREAR / EDITAR --}}
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            {{ isset($usuarioEdit) ? 'Editar Usuario' : 'Crear Usuario' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($usuarioEdit) ? route('usuarios.update', $usuarioEdit) : route('usuarios.store') }}" method="POST">
                @csrf
                @if(isset($usuarioEdit))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ $usuarioEdit->name ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $usuarioEdit->email ?? '' }}" required>
                </div>
                @if(!isset($usuarioEdit))
                <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                @endif
                <div class="mb-3">
                    <label>Rol</label>
                    <select name="role" class="form-control" required>
                        <option value="admin" {{ (isset($usuarioEdit) && $usuarioEdit->role == 'admin') ? 'selected' : '' }}>Admin</option>
                        <option value="cliente" {{ (isset($usuarioEdit) && $usuarioEdit->role == 'cliente') ? 'selected' : '' }}>Cliente</option>
                        <option value="empleado" {{ (isset($usuarioEdit) && $usuarioEdit->role == 'empleado') ? 'selected' : '' }}>Empleado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">{{ isset($usuarioEdit) ? 'Actualizar' : 'Crear' }}</button>
                @if(isset($usuarioEdit))
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                @endif
            </form>
        </div>
    </div>

    {{-- LISTADO --}}
    <div class="card">
        <div class="card-header bg-dark text-white">
            Lista de Usuarios
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->role }}</td>
                        <td>
                            <a href="{{ route('usuarios.index', ['edit' => $usuario->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
