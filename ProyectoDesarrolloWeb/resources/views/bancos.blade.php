@extends('layout.plantilla')

@section('tituloPagina', 'Bancos')

@section('contenido') 
<br><br><br>
<div class="container">
    <div class="card p-4"> <!-- Añadido padding con la clase p-4 de Bootstrap -->
        <h2>Movimientos de Bancos</h2>
        
        <!-- Botones para filtrar los movimientos -->
        <form method="GET" action="{{ route('bancos') }}" class="mb-3">
            <button type="submit" name="tipo" value="ingreso" class="btn btn-primary">Mostrar Ingresos</button>
            <button type="submit" name="tipo" value="egreso" class="btn btn-primary">Mostrar Egresos</button>
            <button type="submit" name="tipo" value="" class="btn btn-secondary">Mostrar Todos</button>
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
                            <td>Q{{ $movimiento->monto }}</td>
                            <td>Q{{ $movimiento->saldo }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('bancos.pdf') }}" class="btn btn-primary">Generar Resumen Financiero</a>
        </div>
        
        <!-- Mostrar totales -->
        <div class="mt-3">
            @if (request('tipo') === 'ingreso')
                <h5>Total Ingresos: Q{{ $totalIngresos }}</h5>
            @elseif (request('tipo') === 'egreso')
                <h5>Total Egresos: Q{{ $totalEgresos }}</h5>
            @else
                <h5>Total Ingresos: Q{{ $totalIngresos }}</h5>
                <h5>Total Egresos: Q{{ $totalEgresos }}</h5>
            @endif
        </div>
    </div>
</div>
@endsection
