@extends('layout.plantilla')

@section('tituloPagina', 'Producción')

@section('contenido')
<div class="card">
    <h5 class="card-header">Actualizar producto</h5>
    <div class="card-body">
        <p class="card-text">
            <form action="{{route("updatep", $productos->id)}}" method="POST" class="formeditar">
                @csrf
                @method("PUT")
                <label class="form-label" for="">Nombre</label>
                <input type="text" name="nombre" class="form-control required" required value="{{$productos->nombre}}"> 
                <label class="form-label" for="">existencia</label>
                <input type="text" name="existencia" class="form-control required" required value="{{$productos->existencia}}">
                <label class="form-label" for="">descripcion</label>
                <input type="text" name="descripcion" class="form-control required" required value="{{$productos->descripcion}}">
                <label class="form-label" for="">precio unitario</label>
                <input type="text" name="precio_unitario" class="form-control required" required value="{{$productos->precio_unitario}}">
                <label class="form-label" for="">fecha ingreso</label>
                <input type="date" name="fecha_ingreso" class="form-control required" required value="{{$productos->fecha_ingreso}}">
                <label class="form-label" for="">fecha vencimiento</label>
                <input type="date" name="fecha_vencimiento" class="form-control required" required value="{{$productos->fecha_vencimiento}}">
                <br>
                <a href="{{route('productot')}}" class="btn btn-info">
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
