@extends('layout/plantilla')
@section('tituloPagina', 'Productos Terminados')
@section('contenido')
<br><br>
<div class="card">
    <h5 class="card-header">Inventario productos</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-sn-12">
          @if ($mensaje = Session::get('success'))
          <div class="alert alert-success" role="alert">
            {{$mensaje}}
          </div>    
          @endif
        </div>
      </div>
      <h5 class="card-title text-center">Productos terminados</h5>
      <p class="card-text">
        <p>
            <a href="{{ route('agregarp') }}" class="btn btn-primary">
              <span class="fa-solid fa-plus"></span> Agregar
            </a>
        </p>
        <hr>
        <p class="card-text">  
        <div class= "table table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <th>nombre</th>
                    <th>existencia</th>  
                    <th>descripcion</th>
                    <th>precio unidad</th>
                    <th>fecha ingreso</th>  
                    <th>fecha vencimiento</th> 
                    <th>Editar</th>
                    <th>Eliminar</th>
                </thead>   
            <tbody>
                @foreach ($datos as $item)
                <tr>
                  <td>{{$item->nombre}}</td> 
                  <td>{{$item->existencia}}</td>  
                  <td>{{$item->descripcion}}</td>  
                  <td>{{$item->precio_unitario}}</td>  
                  <td>{{$item->fecha_ingreso}}</td>
                  <td>{{$item->fecha_vencimiento}}</td>
                  <td>
                    <form action="{{route("actualizarp", $item->id)}}" method="GET">
                      <button class="btn btn-warning btn-sm">
                        <span class="fa-solid fa-pencil"></span>
                      </button>
                    </form>
                  </td>
                  <td>
                    <form action="{{route("showp", $item->id)}}" method="GET">
                      <button class="btn btn-danger btn-sm">
                        <span class="fas fa-minus"></span>  
                      </button>
                    </form>
                  </td>  
                </tr>
                @endforeach
            </tbody>
          </table>   
        </div>
        </p>
      </p>
    </div>
  </div>
<div class="row">
@endsection