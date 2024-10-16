@extends('layout.plantilla')

@section('tituloPagina', 'Producción')

@section('contenido')
<div class="card">
    <h5 class="card-header">Eliminar producto</h5>
    <div class="card-body">
        <p class="card-text">
            <div class="alert alert-danger" role="alert">
                Estas seguro de eliminar este registo!!!
                <table class="table table-sm table-hover table-bordered eliminar-table" style="background-color: white;">
                    <thead>
                        <th>Nombre</th>
                        <th>Existencia</th>
                        <th>descripcion</th>
                        <th>precio unitario</th>
                        <th>Fecha ingreso</th>
                        <th>Fecha vencimiento</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$productos-> nombre}}</td>
                            <td>{{$productos-> existencia}}</td>
                            <td>{{$productos-> descripcion}}</td>
                            <td>Q{{$productos-> precio_unitario}}</td>
                            <td>{{$productos-> fecha_ingreso}}</td>
                            <td>{{$productos-> fecha_vencimiento}}</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <form action="{{route('destroyp', $productos->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{route('productot')}}" class="btn btn-info">
                        <span class="fas fa-undo"></span> Regresar
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
