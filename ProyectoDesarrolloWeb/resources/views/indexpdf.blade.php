@extends('layout.plantilla')

@section('tituloPagina', 'Registro Ventas')

@section('contenido')
    <style>
        h1 {
            color: #343a40;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Estilo para los botones */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .btn:hover {
            background-color: #218838;
        }

        .button-container {
            margin-top: 20px;
            text-align: center;
        }

    </style>

    <div class="container">
        <h1>Listado de Ventas</h1>

        <!-- Tabla de ventas con estilo de bootstrap -->
        <div class="table-responsive">
            <table class="table table-sm table-bordered movimientos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Fecha de Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id }}</td>
                            <td>{{ $venta->cliente->Empresa_Cliente }}</td>
                            <td>{{ $venta->fecha_venta }}</td>
                            <td>
                                <a class="btn" href="{{ route('pdf', $venta->id) }}">Descargar PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón para regresar -->
        <div class="button-container">
            <a href="{{ route('ventacliente') }}" class="btn btn-primary">Regresar</a>
        </div>
    </div>
@endsection
