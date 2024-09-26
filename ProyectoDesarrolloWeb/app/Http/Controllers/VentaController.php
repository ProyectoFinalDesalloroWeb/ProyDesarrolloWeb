<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\productosfinales;
use App\Models\Ventas;
use App\Models\DetalleVentas;
use Barryvdh\DomPDF\Facade\Pdf;

class VentaController extends Controller
{
    public function mostrarCliente()
    {
        $clientes = Clientes::all(); // Obtener todos los clientes
        return view('ventacliente', compact('clientes'));
    }

    public function mostrarProductos(Request $request)
    {
        $clienteId = $request->input('cliente_id');
        $productos = productosfinales::all(); // Obtener todos los productos
        return view('ventaproducto', compact('clienteId', 'productos'));
    }

    public function guardarVenta(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'productos' => 'required|array', // Asegúrate de que los productos sean un array
        'productos.*.id' => 'required|exists:productosfinales,id', // Validar que cada producto existe
        'productos.*.cantidad' => 'required|integer|min:1', // Validar que la cantidad sea válida
    ]);

    // Obtener la información del cliente y la fecha actual
    $clienteId = $request->input('cliente_id');
    $fechaActual = now();

    // Crear una nueva venta
    $venta = new Ventas();
    $venta->cliente_id = $clienteId;
    $venta->fecha_venta = $fechaActual;
    $venta->save();

    // Almacenar los detalles de la venta
    foreach ($request->input('productos') as $producto) {
        // Aquí puedes ajustar cómo almacenar el detalle de la venta
        $detalleVenta = new DetalleVentas();
        $detalleVenta->venta_id = $venta->id; // Asigna la ID de la venta
        $detalleVenta->producto_id = $producto['id']; // ID del producto
        $detalleVenta->cantidad = $producto['cantidad']; // Cantidad del producto
        $detalleVenta->precio_unitario = productosfinales::find($producto['id'])->precio_unitario; // Obtener precio unitario
        $detalleVenta->subtotal = $detalleVenta->precio_unitario * $detalleVenta->cantidad; // Calcular subtotal
        $detalleVenta->save();
        
        // Actualizar el stock del producto (si es necesario)
        $productoFinal = productosfinales::find($producto['id']);
        $productoFinal->existencia -= $producto['cantidad'];
        $productoFinal->save();
    }

    // Redirigir o mostrar un mensaje de éxito
    return redirect()->route('ventacliente')->with('success', 'Venta guardada correctamente.');
}



//-------------------------------------

public function index()
    {
        $ventas = Ventas::with('cliente')->get();
        return view('indexpdf', compact('ventas'));
    }

    public function generarPDF($ventaId)
    {
        // Obtener la venta y los detalles de la venta
        $venta = Ventas::with('cliente')->findOrFail($ventaId);
        $detalles = DetalleVentas::where('venta_id', $ventaId)->get();

        // Cargar la vista para el PDF
        $pdf = PDF::loadView('pdf', compact('venta', 'detalles'));

        // Devolver el PDF
        return $pdf->download('venta_' . $venta->id . '.pdf');
    }
}
