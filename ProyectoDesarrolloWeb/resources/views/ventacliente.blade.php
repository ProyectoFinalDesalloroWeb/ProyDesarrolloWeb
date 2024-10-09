@extends('layout.plantilla')

@section('tituloPagina', 'Seleccionar Cliente')

@section('contenido')

<div class="container mt-5">
    <h1 class="mb-4">Seleccionar Cliente</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('ventaproducto') }}" method="POST">
        @csrf

        <!-- Selección del Cliente -->
        <div class="form-group row align-items-center">
            <label for="cliente" class="col-sm-2 col-form-label fs-4 font-weight-bold text-primary">
                Cliente
            </label>
            <div class="col-sm-6">
                <select name="cliente_id" id="cliente" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->Codigo }} - {{ $cliente->Empresa_Cliente }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Botones -->
        <div class="form-group mt-4">
            <!-- Botón para continuar -->
            <button type="submit" class="btn btn-primary">Continuar</button>

            <!-- Botón para ir a la página de ventas -->
            <a href="{{ route('indexpdf') }}" class="btn btn-primary">Ver Ventas</a>
        </div>
    </form>
</div>

@endsection