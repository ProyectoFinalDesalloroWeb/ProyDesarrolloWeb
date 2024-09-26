@extends('layout.plantilla')

@section('tituloPagina', 'Seleccionar Cliente')

@section('contenido')

<div class="container">
    <h1>Seleccionar Cliente</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('productos') }}" method="POST">
        @csrf

        <!-- Selección del Cliente -->
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <select name="cliente_id" id="cliente" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->Codigo }} - {{ $cliente->Empresa_Cliente }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón para avanzar a la selección de productos -->
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
</div>

@endsection
