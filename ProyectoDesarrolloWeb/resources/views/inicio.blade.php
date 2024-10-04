@extends('layout.plantilla')

@section('titulopagina', 'Inventario')

@section('contenido')
    <br>
    <div class="card">
        <h5 class="card-header text-center">Inventario</h5>
        <div class="card-body">
            <div class="row">

                <!-- Modificación Mensaje de éxito -->
                <div class="col-sm-12">
                    @if ($mensaje = Session::get('success'))
                        <div class="alert alert-success" id="successMessage" role="alert">
                            {{ $mensaje }}
                        </div>
                    @endif
                </div>

            </div>

            <h5 class="card-title text-center">Materia Prima</h5>

            <!-- Botones para ir a otras vistas -->
            <div class="d-flex justify-content-between mb-4">
                <!-- Botón para agregar materia prima -->
                <a href="{{ route('productos.create') }}" class="btn btn-primary">
                    <span class="fa-solid fa-plus"></span> Agregar Materia Prima
                </a>

                <!-- Botón para ver el registro de movimientos -->
                <a href="{{ route('registro') }}" class="btn btn-primary">
                    <span class="fa-solid fa-list"></span> Registro de Movimientos
                </a>

                <!-- Buscador -->
                <form action="{{ route('productos.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre...">
                    <button type="submit" class="btn btn-primary ml-2 d-flex align-items-center">
                        <span class="fa-solid fa-magnifying-glass me-2"></span> Buscar
                    </button>
                </form>
            </div>

            <hr>

            <p class="card-text">
            <div class="table-responsive"></div>
            <table class="table table-sm table-bordered inventario-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Unidad Medida</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Proveedor</th>
                        <th>Fecha de Adquisicion</th>
                        <th>Fecha de Expiracion</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->unidad_medida }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>Q{{ $item->precio_unitario }}</td>
                            <td>{{ $item->proveedor }}</td>
                            <td>{{ $item->fecha_adquisicion }}</td>
                            <td>{{ $item->fecha_expiracion }}</td>
                            <td>
                                <form action="{{ route('productos.edit', $item->id) }}" method="GET">
                                    <button class="btn btn-warning">
                                        <span class="fa-solid fa-pencil"></span>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('productos.show', $item->id) }}" method="GET">
                                    <button class="btn btn-danger">
                                        <span class="fas fa-minus"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </p>

            <hr>
            <div class="row">
                <div class="col-sm-12">
                    {{ $datos->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000); // 3000 ms = 3 segundos
    </script>

@endsection
