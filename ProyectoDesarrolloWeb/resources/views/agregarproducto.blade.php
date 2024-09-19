@extends('layout.plantilla')

@section('tituloPagina', 'Producción')

@section('contenido')
<div class="card">
    <h5 class="card-header">Agregar producto</h5>
    <div class="card-body">
        <p class="card-text">
            <form action="{{route('storep')}}" method="POST">
                @csrf
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
                <label for="">existencia</label>
                <input type="text" name="existencia" class="form-control" required>
                <label for="">descripcion</label>
                <input type="text" name="descripcion" class="form-control" required>
                <label for="">precio unitario</label>
                <input type="text" name="precio_unitario" class="form-control" required>
                <label for="">fecha ingreso</label>
                <input type="date" name="fecha_ingreso" class="form-control" required>
                <label for="">fecha vencimiento</label>
                <input type="date" name="fecha_vencimiento" class="form-control" required>
                <br>
                <a href="{{route('productot')}}" class="btn btn-info">
                    <span class="fas fa-undo"></span> Regresar
                </a>
                <button class="btn btn-primary">
                    <span class="fas fa-plus"></span> Agregar
                </button>
            </form>
        </p>
    </div>
</div>

@endsection
