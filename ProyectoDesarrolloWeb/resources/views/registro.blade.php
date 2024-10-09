@extends('layout.plantilla')

@section('tituloPagina', 'Registro de Movimientos')

@section('contenido')
<br>
    <div class="card">
        <h5 class="card-header text-center">Registro de Movimientos</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    @if ($mensaje = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $mensaje }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tabla de movimientos -->
            <div class='table table-responsive'>
                <table class="table table-sm table-bordered movimientos-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Tipo Movimiento</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $movimiento)
                            <tr>
                                <td>{{ $movimiento->producto->nombre }}</td>
                                <td>{{ ucfirst($movimiento->tipo_movimiento) }}</td>
                                <td>{{ $movimiento->cantidad }}</td>
                                <td>{{ $movimiento->fecha_movimiento }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            <!-- Botón para regresar al inventario -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('productos.index') }}" class="btn btn-info">
                    <span class="fas fa-undo"></span> Regresar al Inventario
                </a>
            </div>
        </div>
    </div>
@endsection


