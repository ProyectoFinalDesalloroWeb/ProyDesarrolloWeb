@extends('layout.plantilla')

@section('tituloPagina', 'Bancos')

@section('contenido') 
<br><br><br>
<div class="container">
    <div class="card p-4"> <!-- Añadido padding con la clase p-4 de Bootstrap -->
        <h2>Movimientos de Bancos</h2>
        <p class="card-text">
            <a href="{{ route('bancos.pdf') }}" class="btn btn-primary">Generar PDF</a>

            <div class="table-responsive"> 
                <table class="table table-sm table-bordered inventario-table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $movimiento)
                            <tr>
                                <td>{{ $movimiento->fecha }}</td>
                                <td>{{ $movimiento->descripcion }}</td>
                                <td>{{ $movimiento->tipo }}</td>
                                <td>{{ $movimiento->monto }}</td>
                                <td>{{ $movimiento->saldo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </p>
    </div>
</div>
@endsection

