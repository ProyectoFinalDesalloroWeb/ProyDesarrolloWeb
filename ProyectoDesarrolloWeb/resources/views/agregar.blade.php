@extends('layout/plantilla')

@section('tituloPagina', 'Insertar')

@section('contenido')


    <br>
    <div class="card">
        <h5 class="card-header">Agregar nueva materia prima</h5>
        <div class="card-body">

            <p class="card-text">
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>

                <label for="">Descripcion</label>
                <input type="text" name="descripcion" class="form-control" required>

                <label for="unidad_medida">Unidad de medidad</label>
                <select name="unidad_medida" class="form-control" required>
                    <option value="kilogramos">Kilogramos</option>
                    <option value="gramos">Gramos</option>
                    <option value="litros">Litros</option>
                    <option value="mililitros">Mililitros</option>
                </select>

                <label for="">Cantidad</label>
                <input type="text" name="cantidad" class="form-control" required>

                <label for="">Precio unitario</label>
                <input type="text" name="precio_unitario" class="form-control" required>

                <label for="">Proveedor</label>
                <input type="text" name="proveedor" class="form-control" required>

                <label for="">Fecha de adquisicion</label>
                <input type="date" name="fecha_adquisicion" class="form-control" required>

                <label for="">Fecha de expiracion</label>
                <input type="date" name="fecha_expiracion" class="form-control" required>

                <br>
                <a href="{{ route('productos.index') }}" class="btn btn-info">
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