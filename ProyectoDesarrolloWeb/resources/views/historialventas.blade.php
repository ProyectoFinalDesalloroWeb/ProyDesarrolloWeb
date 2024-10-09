@extends('layout.plantillaclientes')

@section('tituloPagina', 'Historial de Compras')

@section('contenido')
    <div class="card">
        <div class="container mt-4">
            <h1 class="card-title">Historial de Compras</h1>

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Mensaje de error -->
            @if ($errors->any())
                <div class="alert alert-danger" role="alert" style="margin-bottom: 20px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario de búsqueda y botón Mostrar Todos en la misma línea -->
            <div class="mb-3 d-flex justify-content-between">
                <form method="GET" action="{{ route('ventas.buscar') }}" class="d-flex align-items-center">
                    <input type="hidden" name="query" value="">
                    <button class="btn btn-primary me-2" type="submit">Mostrar Todos</button>
                </form>

                <form method="GET" action="{{ route('ventas.buscar') }}" class="d-flex align-items-center">
                    <input type="text" id="search" class="form-control me-2" name="query"
                        placeholder="Buscar por nombre o código..." required value="{{ request('query') }}">
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <span class="fa-solid fa-magnifying-glass me-2"></span> Buscar
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center" id="clientesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código Cliente</th>
                            <th>Cliente</th>
                            <th>NIT</th>
                            <th>Fecha de Venta</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td class="align-middle">{{ $venta->id }}</td>
                                <td class="align-middle">{{ $venta->cliente->Codigo }}</td>
                                <td class="align-middle">{{ $venta->cliente->Empresa_Cliente }}</td>
                                <td class="align-middle">{{ $venta->cliente->NIT }}</td>
                                <td class="align-middle">{{ $venta->fecha_venta }}</td>
                                <td class="align-middle">
                                    {{ $venta->cliente->Departamento }},<br>
                                    {{ $venta->cliente->Municipio }},<br>
                                    {{ $venta->cliente->Completar_Direccion }}<br>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-column">
                                        <!-- Botón Descargar PDF -->
                                        <a class="btn btn-info btn-sm mb-2" href="{{ route('pdf', $venta->id) }}">Descargar PDF</a>

                                        <!-- Botón Detalles de Compra que abre el modal -->
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detallesModal{{ $venta->id }}">
                                            Detalles de Compra
                                        </button>
                                    </div>

                                    <!-- Modal para mostrar los detalles de la compra -->
                                    <div class="modal fade" id="detallesModal{{ $venta->id }}" tabindex="-1"
                                        aria-labelledby="detallesModalLabel{{ $venta->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title text-center" id="detallesModalLabel{{ $venta->id }}">
                                                        Detalles de la Compra #{{ $venta->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mx-auto text-center">
                                                            <p><strong>Código Cliente:</strong> {{ $venta->cliente->Codigo }}</p>
                                                            <p><strong>Cliente:</strong> {{ $venta->cliente->Empresa_Cliente }}</p>
                                                            <p><strong>Fecha de Venta:</strong> {{ $venta->fecha_venta }}</p>
                                                            <p><strong>Total de Ventas:</strong> Q{{ number_format($venta->total_venta, 2) }}</p>
                                                        </div>
                                                    </div>

                                                    <h6 class="mt-3 text-center"><strong>Productos:</strong></h6>
                                                    <ul class="list-group">
                                                        @foreach ($venta->productos as $producto)
                                                            <li class="list-group-item text-center">
                                                                {{ $producto->nombre }} - 
                                                                Q{{ number_format($producto->pivot->precio_unitario, 2) }} 
                                                                (Cantidad: {{ $producto->pivot->cantidad }})
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Botón para regresar -->
            <div class="button-container mt-3">
                <a href="{{ route('inicioclientes') }}" class="btn btn-primary">Regresar</a>
            </div>
        </div>
        <br>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection