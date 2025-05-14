@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Menú disponible</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($menus as $menu)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($menu->imagen)
                        <img src="{{ $menu->imagen }}" class="card-img-top" alt="{{ $menu->nombre }}">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=Sin+Imagen" class="card-img-top" alt="Sin imagen">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->nombre }}</h5>
                        <p class="card-text">{{ $menu->descripcion }}</p>
                        <p><strong>Precio: ${{ $menu->precio }}</strong></p>
                        {{-- Botón para agregar a orden (puede ser futuro formulario o modal) --}}
                        <form action="#" method="POST" onsubmit="return confirm('¿Agregar {{ $menu->nombre }} a la orden?');">
                            {{-- Aquí puedes colocar lógica futura --}}
                            <button type="submit" class="btn btn-success btn-sm">Agregar a orden</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
