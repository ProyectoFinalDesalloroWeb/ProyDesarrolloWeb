@extends('layout.plantilla')

@section('tituloPagina', 'Seleccionar Productos')

@section('contenido')

<div class="container mt-5">
    <h1 class="mb-4">Seleccionar Productos</h1>

    <!-- Formulario para seleccionar productos y registrar la venta -->
    <form id="ventaForm" action="{{ route('guardar.venta') }}" method="POST">
        @csrf

        <!-- Campo oculto para el ID del cliente -->
        <input type="hidden" name="cliente_id" value="{{ $clienteId }}">

        <!-- Selección de productos y cantidad -->
        <div class="form-group row align-items-center">
            <!-- Seleccionar Producto -->
            <label for="productoSelect" class="col-sm-2 col-form-label">Seleccionar Producto</label>
            <div class="col-sm-3">
                <select id="productoSelect" class="form-control">
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}" data-stock="{{ $producto->stock }}">
                            {{ $producto->nombre }} - Precio: ${{ number_format($producto->precio_unitario, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Mostrar existencias en un input de solo lectura -->
            <label for="existencias" class="col-sm-1 col-form-label">Existencias</label>
            <div class="col-sm-2">
                <input type="text" id="existencias" class="form-control" value="-" disabled>
            </div>

            <!-- Campo de cantidad -->
            <label for="cantidad" class="col-sm-1 col-form-label">Cantidad</label>
            <div class="col-sm-2">
                <input type="number" id="cantidad" class="form-control" min="1" value="1" required>
            </div>
        </div>

        <!-- Botón para agregar productos a la lista -->
        <button type="button" id="agregarProductoBtn" class="btn btn-success mb-3">Agregar Producto</button>

        <!-- Mensaje de error si no hay existencias suficientes -->
        <div id="errorExistencias" class="alert alert-danger d-none">
            La cantidad seleccionada supera las existencias disponibles.
        </div>

        <!-- Tabla para mostrar los productos agregados -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="productosAgregados">
                <!-- Aquí se irán mostrando las filas con productos agregados -->
            </tbody>
        </table>

        <!-- Mensaje de error si no hay productos -->
        <div id="errorMensaje" class="alert alert-danger d-none">
            Debes agregar al menos un producto a la lista antes de guardar la venta.
        </div>

        <!-- Botón para guardar la venta -->
        <button type="submit" class="btn btn-primary">Guardar Venta</button>
    </form>
</div>

<script>
    // Variables para almacenar la lista de productos y sus cantidades
const productosAgregados = document.getElementById('productosAgregados');
const productoSelect = document.getElementById('productoSelect');
const cantidadInput = document.getElementById('cantidad');
const ventaForm = document.getElementById('ventaForm');
const errorMensaje = document.getElementById('errorMensaje');
const stockDisponibleInput = document.getElementById('existencias');
const errorExistencias = document.getElementById('errorExistencias');

// Objeto para almacenar el stock restante de cada producto
let stockRestante = {};

// Al cambiar el producto seleccionado, obtener el stock desde el servidor
productoSelect.addEventListener('change', function() {
    const productoId = productoSelect.value;

    if (productoId) {
        // Hacer una solicitud AJAX a la ruta para obtener el stock del producto
        fetch(`/obtener-stock/${productoId}`)
            .then(response => response.json())
            .then(data => {
                // Actualizar el stock en el input y el objeto stockRestante
                const stock = data.stock;
                stockDisponibleInput.value = stock;
                stockRestante[productoId] = stock;
                errorExistencias.classList.add('d-none'); // Ocultar mensaje de error si se estaba mostrando
            })
            .catch(error => {
                console.error('Error al obtener el stock:', error);
                stockDisponibleInput.value = '-'; // Resetear a vacío en caso de error
            });
    } else {
        stockDisponibleInput.value = '-';
    }
});

// Botón de agregar producto a la lista
document.getElementById('agregarProductoBtn').addEventListener('click', function() {
    const productoId = productoSelect.value;
    const cantidad = parseInt(cantidadInput.value);
    const productoNombre = productoSelect.options[productoSelect.selectedIndex].dataset.nombre;
    const stockActual = stockRestante[productoId]; // Obtener el stock actualizado del objeto

    // Validar selección de producto y cantidad
    if (!productoId || cantidad <= 0) {
        alert('Seleccione un producto y una cantidad válida.');
        return;
    }

    // Validar cantidad contra existencias disponibles
    if (cantidad > stockActual) {
        errorExistencias.classList.remove('d-none');
        return;
    }

    // Crear una nueva fila en la tabla con los detalles del producto
    const fila = document.createElement('tr');
    fila.innerHTML = `
        <td>${productoNombre}</td>
        <td>
            <input type="hidden" name="productos[${productoId}][id]" value="${productoId}">
            <input type="hidden" name="productos[${productoId}][cantidad]" value="${cantidad}">
            ${cantidad}
        </td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this, ${productoId})">Eliminar</button></td>
    `;

    // Agregar la fila a la tabla
    productosAgregados.appendChild(fila);

    // Restar la cantidad seleccionada del stock restante
    stockRestante[productoId] -= cantidad;

    // Ocultar la opción en lugar de eliminarla
    const optionToHide = productoSelect.querySelector(`option[value='${productoId}']`);
    if (optionToHide) {
        optionToHide.style.display = 'none';
    }

    // Limpiar los campos de selección y cantidad
    productoSelect.value = '';
    cantidadInput.value = 1;
    stockDisponibleInput.value = '-'; // Resetear el stock mostrado

    // Ocultar mensajes de error
    errorMensaje.classList.add('d-none');
    errorExistencias.classList.add('d-none');
});

// Función para eliminar una fila de la tabla y regresar la opción eliminada al select
function eliminarFila(boton, productoId) {
    const fila = boton.closest('tr');
    productosAgregados.removeChild(fila);

    // Recuperar el nombre del producto usando el dataset del botón
    const productoNombre = boton.closest('tr').cells[0].textContent;
    const cantidad = parseInt(boton.closest('tr').cells[1].textContent, 10);

    // Restablecer el stock del producto
    stockRestante[productoId] += cantidad;

    // Mostrar nuevamente la opción eliminada en el select
    const optionToShow = productoSelect.querySelector(`option[value='${productoId}']`);
    if (optionToShow) {
        optionToShow.style.display = 'block';
    }
}

// Validación al enviar el formulario
ventaForm.addEventListener('submit', function(event) {
    if (productosAgregados.children.length === 0) {
        // Si no hay productos en la lista, mostrar un mensaje de error
        errorMensaje.classList.remove('d-none');
        event.preventDefault(); // Evitar el envío del formulario
    }
});
</script>

@endsection
