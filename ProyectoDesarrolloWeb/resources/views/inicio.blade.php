@extends('layout/plantilla')

@section('titulopagina', 'Inventario')

@section('contenido')

    <div class="card">
        <h5 class="card-header">Inventario</h5>
        <div class="card-body">
            <div class="row">
                <div class"col-sm-12">
                    @if ($mensaje =Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{$mensaje}}
                    </div>
                    @endif
                </div>
            </div>
            <h5 class="card-title">Materia Prima</h5>
            <p>
                <a href="{{ route('productos.create') }}" class="btn btn-primary">
                    <span class="fa-solid fa-plus "></span> Agregar Materia Prima
                </a>
            </p>
            <hr>
            <p class="card-text">
            <div class='table table-responsive'></div>
            <table class="table table-sm table-bordered">
                <thead>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Unidad Medida</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Proveedor</th>
                    <th>Fecha de Adquisicion</th>
                    <th>Fecha de Expiracion</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->unidad_medida }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>{{ $item->precio_unitario }}</td>
                            <td>{{ $item->proveedor }}</td>
                            <td>{{ $item->fecha_adquisicion }}</td>
                            <td>{{ $item->fecha_expiracion }}</td>
                            <td>{{ $item->estado }}</td>
                            <td>
                                <form action="{{ route('productos.edit', $item->id) }}" method="GET">
                                    <button class="btn btn-warning" type="submit">
                                        <span class="fa-solid fa-pencil"></span>
                                    </button>
                                </form>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </p>
    </div>
    </div>
@endsection
