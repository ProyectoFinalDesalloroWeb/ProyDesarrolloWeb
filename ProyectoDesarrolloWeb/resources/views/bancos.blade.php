@extends('layout.plantilla')

@section('tituloPagina', 'Bancos')

@section('contenido') 
<br><br><br>
<div class="container">
    <div class="card p-4"> <!-- Añadido padding con la clase p-4 de Bootstrap -->
        <h2>Movimientos de Bancos</h2>

        <!-- Formulario para filtrar por fecha y tipos de movimientos -->
        <form method="GET" action="{{ route('bancos') }}" class="mb-3">
            <div class="form-row align-items-end">
                <div class="col-md-4 mb-3">
                    <label for="fecha">Buscar por fecha:</label>
                    <div class="input-group">
                        <input type="date" name="fecha" class="form-control" value="{{ request('fecha') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success">Buscar</button> <!-- Botón de búsqueda al lado del input -->
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-3">
                    <div class="btn-group">
                        <button type="submit" name="tipo" value="ingreso" class="btn btn-primary" onclick="clearDate()">Mostrar Ingresos</button>
                        <button type="submit" name="tipo" value="egreso" class="btn btn-primary" onclick="clearDate()">Mostrar Egresos</button>
                        <button type="submit" name="tipo" value="" class="btn btn-primary" onclick="clearDate()">Mostrar Todos</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive"> 
            <table class="table table-sm table-bordered inventario-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movimientos as $movimiento)
                        <tr>
                            <td>{{ $movimiento->fecha }}</td>
                            <td>{{ $movimiento->descripcion }}</td>
                            <td>{{ $movimiento->tipo }}</td>
                            <td>Q{{ number_format($movimiento->monto, 2) }}</td> <!-- Formatear monto -->
                            <td>Q{{ number_format($movimiento->saldo, 2) }}</td> <!-- Formatear saldo -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('bancos.pdf') }}" class="btn btn-primary">Generar Resumen Financiero</a>
        </div>
        
        <!-- Mostrar totales -->
        <div class="mt-3">
            @if (request('tipo') === 'ingreso')
                <h5>Total Ingresos: Q{{ number_format($totalIngresos, 2) }}</h5> 
            @elseif (request('tipo') === 'egreso')
                <h5>Total Egresos: Q{{ number_format($totalEgresos, 2) }}</h5> 
            @else
                <h5>Total Ingresos: Q{{ number_format($totalIngresos, 2) }}</h5> 
                <h5>Total Egresos: Q{{ number_format($totalEgresos, 2) }}</h5> 
            @endif
        </div>
    </div>
</div>

<script>
    function clearDate() {
        const dateInput = document.querySelector('input[name="fecha"]');
        dateInput.value = ''; // Limpiar el campo de fecha
    }
</script>
@endsection

