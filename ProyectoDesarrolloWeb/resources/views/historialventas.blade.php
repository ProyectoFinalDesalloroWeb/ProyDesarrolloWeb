@extends('layout.plantillaclientes')

@section('tituloPagina', 'Historial de Compras')

@section('contenido')
    <div class="card">
        <div class="container mt-4">
            <h1 class="card-title">Historial de Compras</h1>

                        <!-- Mensaje de éxito -->
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
        
                    <!-- Mensaje de error -->
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert" style="margin-bottom: 20px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
        
@endsection
