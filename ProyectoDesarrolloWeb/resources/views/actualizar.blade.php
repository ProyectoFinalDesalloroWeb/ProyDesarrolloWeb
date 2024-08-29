@extends('layout/plantilla')

@section('tituloPagina', 'ACTUALIZAR')

@section('contenido')



    <div class="card">
        <h5 class="card-header">Actualizar materia prima</h5>
        <div class="card-body">
            <p class="card-text">
            <form action="{{ route('productos.update' , $productos->id) }}" method="POST">
                @csrf
                @method("PUT")
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control" required value="{{$productos->nombre}}">

                <label for="">Descripcion</label>
                <input type="text" name="descripcion" class="form-control" required value="{{$productos->descripcion}}">

                <label for="unidad_medida">Unidad de medidad</label>
                <select name="unidad_medida" class="form-control" required value="{{$productos->unidad_medida}}">
                    <option value="kilogramos">Kilogramos</option>
                    <option value="gramos">Gramos</option>
                    <option value="litros">Litros</option>
                    <option value="mililitros">Mililitros</option>
                </select>

                <label for="">Cantidad</label>
                <input type="text" name="cantidad" class="form-control" required value="{{$productos->cantidad}}">

                <label for="">Precio unitario</label>
                <input type="text" name="precio_unitario" class="form-control" required value="{{$productos->precio_unitario}}">

                <label for="">Proveedor</label>
                <input type="text" name="proveedor" class="form-control" required value="{{$productos->proveedor}}">

                <label for="">Fecha de adquisicion</label>
                <input type="date" name="fecha_adquisicion" class="form-control" required value="{{$productos->fecha_adquisicion}}">

                <label for="">Fecha de expiracion</label>
                <input type="date" name="fecha_expiracion" class="form-control" required value="{{$productos->fecha_expiracion}}">

                <label for="estado">Estado</label>
                <select name="estado" class="form-control" required value="{{$productos->estado}}">
                    <option value="activa">Activa</option>
                    <option value="inactiva">Inactiva</option>
                </select>
                <br>
                <a href="{{ route('productos.index') }}" class="btn btn-info">
                    <span class="fas fa-undo"></span> Regresar
                </a>
                <button class="btn btn-warning">
                    <span class="fa-solid fa-sync-alt"></span> Actualizar
                </button>
                
            </form>
            </p>

        </div>
    </div>
@endsection