@extends('layout/plantilla')

@section('tituloPagina', 'Actualizar')

@section('contenido')
<br>
    <div class="card">
        <h5 class="card-header">Actualizar materia prima</h5>
        <div class="card-body">
            <p class="card-text">
            <form action="{{ route('productos.update', $productos->id) }}" method="POST" class="formeditar">
                @csrf
                @method("PUT")
                
                <label class="form-label" for="">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required value="{{$productos->nombre}}">

                <label class="form-label" for="">Descripcion:</label>
                <input type="text" name="descripcion" class="form-control" required value="{{$productos->descripcion}}">

                <label class="form-label" for="unidad_medida">Unidad de medida:</label>
                <select name="unidad_medida" id="unidad_medida" class="form-control" required>
                    <option value="kilogramos" {{ $productos->unidad_medida == 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                    <option value="gramos" {{ $productos->unidad_medida == 'gramos' ? 'selected' : '' }}>Gramos</option>
                    <option value="litros" {{ $productos->unidad_medida == 'litros' ? 'selected' : '' }}>Litros</option>
                    <option value="mililitros" {{ $productos->unidad_medida == 'mililitros' ? 'selected' : '' }}>Mililitros</option>
                </select>

                <label class="form-label" for="">Cantidad:</label>
                <input type="number" name="cantidad" class="form-control" required value="{{$productos->cantidad}}">

                <label class="form-label" for="">Precio unitario:</label>
                <input type="number" name="precio_unitario" class="form-control" required value="{{$productos->precio_unitario}}">

                <label class="form-label" for="">Proveedor:</label>
                <input type="text" name="proveedor" class="form-control" required value="{{$productos->proveedor}}">

                <label class="form-label" for="">Fecha de adquisicion:</label>
                <input type="date" name="fecha_adquisicion" class="form-control" required value="{{$productos->fecha_adquisicion}}">

                <label class="form-label" for="">Fecha de expiracion:</label>
                <input type="date" name="fecha_expiracion" class="form-control" required value="{{$productos->fecha_expiracion}}">

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
