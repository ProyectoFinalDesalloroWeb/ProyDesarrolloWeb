@extends('layout/plantilla')

@section('tituloPagina', 'ELIMINAR')

@section('contenido')


    <br>
    <div class="card">
        <h5 class="card-header">Eliminar materia prima</h5>
        <div class="card-body">

            <p class="card-text">
            <div class="alert alert-danger" role="alert">
                Estas seguro de eliminar este registro!!!

                <table class="table table-sm table-hover table-bordered" style="background-color: white"">
                    <thead>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Unidad de medida</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Proveedor</th>
                        <th>Fecha de adquisicion</th>
                        <th>Fecha de expiracion</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$productos->nombre }}</td>
                            <td>{{$productos->descripcion }}</td>
                            <td>{{$productos->unidad_medida }}</td>
                            <td>{{$productos->cantidad }}</td>
                            <td>{{$productos->precio_unitario }}</td>
                            <td>{{$productos->proveedor }}</td>
                            <td>{{$productos->fecha_adquisicion }}</td>
                            <td>{{$productos->fecha_expiracion }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <form action="{{route('productos.destroy', $productos->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('productos.index') }}" class="btn btn-info">
                        <span class="fas fa-undo"></span>Regresar
                    </a>
                    <button class="btn btn-danger">
                        <span class="fas fa-minus"></span> Eliminar
                    </button>
                </form>
            </div>
            </p>

        </div>
    </div>
@endsection
