
@extends('layout.plantilla')

@section('tituloPagina', 'Seleccionar Productos')

@section('contenido')

<div class="container mt-5">
    <h1 class="mb-4">Seleccionar Productos</h1>

    <form action="{{ route('guardar.venta') }}" method="POST">
        @csrf
    
        <input type="hidden" name="cliente_id" value="{{ $clienteId }}">
        
        @foreach($productos as $producto)
            <div class="form-group">
                <label>{{ $producto->nombre }}</label>
                <input type="number" name="productos[{{ $loop->index }}][id]" value="{{ $producto->id }}" hidden>
                <input type="number" name="productos[{{ $loop->index }}][cantidad]" min="1" value="1" required>
            </div>
        @endforeach
    
        <button type="submit" class="btn btn-primary">Guardar Venta</button>
    </form>
</div>

@endsection