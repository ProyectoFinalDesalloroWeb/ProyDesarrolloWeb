@extends('layout.plantilla')

@section('tituloPagina', 'Producción')

@section('contenido')

    <h1>Producción de Dulces</h1>

    <form action="{{ route('producir') }}" method="POST">
        @csrf

        <div id="materias-primas">
            <!-- Bloque para seleccionar una materia prima y su cantidad -->
            <div class="materia-prima">
                <label for="producto_id[]">Materia Prima:</label>
                <select name="producto_id[]" class="form-control" required>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }} ({{ $producto->cantidad }} disponibles)</option>
                    @endforeach
                </select>

                <label for="cantidad[]">Cantidad a usar:</label>
                <input type="number" name="cantidad[]" class="form-control" required>
                <button type="button" class="btn btn-danger btn-sm" onclick="quitarMateriaPrima(this)">Quitar materia prima</button>
                <br><br>
            </div>
        </div>

        <br>

        <!-- Botón para añadir más materias primas -->
        <button type="button" class="btn btn-secondary" onclick="agregarMateriaPrima()">Agregar otra materia prima</button>

        <br><br>

        <a href="{{route('eliminarUltimoProducto')}}" class="btn btn-info">
                    <span class="fas fa-undo"></span> Regresar
                </a>
        <button type="submit" class="btn btn-primary">Crear Dulce</button>
    </form>

    <script>
        function agregarMateriaPrima() {
            const div = document.createElement('div');
            div.classList.add('materia-prima');
            div.innerHTML = `
                <label for="producto_id[]">Materia Prima:</label>
                <select name="producto_id[]" class="form-control" required>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }} ({{ $producto->cantidad }} disponibles)</option>
                    @endforeach
                </select>
                <label for="cantidad[]">Cantidad a usar:</label>
                <input type="number" name="cantidad[]" class="form-control" required>
                <button type="button" class="btn btn-danger btn-sm" onclick="quitarMateriaPrima(this)">Quitar materia prima</button>
                <br><br>
            `;
            document.getElementById('materias-primas').appendChild(div);
        }

        function quitarMateriaPrima(button) {
            button.parentElement.remove();
        }
    </script>

@endsection


