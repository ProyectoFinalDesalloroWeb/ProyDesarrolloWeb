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
                                        <!-- Acciones aquí -->
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Botón Descargar PDF -->
            <a class="btn btn-info btn-sm mb-2" href="{{ route('pdf', $venta->id) }}">Descargar PDF</a>

@endsection
