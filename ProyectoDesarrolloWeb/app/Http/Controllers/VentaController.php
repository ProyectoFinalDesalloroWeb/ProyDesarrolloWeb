<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\productosfinales;
use App\Models\Ventas;
use App\Models\DetalleVentas;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Producto;

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

    // Método para guardar la venta sin generar el PDF
    public function guardarVenta(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cliente_id' => 'required',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productosfinales,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Crear la venta
        $venta = new Ventas();
        $venta->cliente_id = $request->cliente_id;
        $venta->fecha_venta = now();
        $venta->save();

        // Almacenar los productos seleccionados en la venta
        foreach ($request->productos as $producto) {
            $productoFinal = productosfinales::find($producto['id']);

            // Usar la tabla intermedia para guardar los detalles de la venta
            $venta->productos()->attach($productoFinal->id, [
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $productoFinal->precio_unitario,
                'subtotal' => $producto['cantidad'] * $productoFinal->precio_unitario,
            ]);

            // Reducir el stock de productos
            $productoFinal->existencia -= $producto['cantidad'];
            $productoFinal->save();
        }

        // Redirigir con un mensaje de éxito después de guardar
        return redirect()->route('ventacliente')->with('success', 'Venta guardada correctamente.');
    }

    // Método para generar el PDF de la factura
    public function generarFacturaPDF($ventaId)
    {
        // Obtener la venta con los detalles
        $venta = Ventas::with('productos', 'cliente')->findOrFail($ventaId);

        // Generar el PDF usando la vista 'factura'
        $pdf = Pdf::loadView('pdf', ['venta' => $venta]);

        // Descargar el archivo PDF
        return view('pdf', compact('venta', 'detalles'));
    }
    public function producto()
    {
        return $this->belongsTo(Productosfinales::class, 'producto_id');
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

    /* Método para devolver la cantidad de stock de un producto
    public function obtenerStock($productoId)
    {
        $producto = Producto::find($productoId);

        if ($producto) {
            return response()->json(['stock' => $producto->stock]);
        } else {
            return response()->json(['stock' => 0]); // Si no encuentra el producto, devolver stock 0
        }
    }
    // Buscar las ventas de un cliente
    public function buscarVentasCliente(Request $request)
    {
        $clienteId = $request->input('cliente_id');
        $ventas = Ventas::where('cliente_id', $clienteId)->get(); // Obtener las ventas del cliente

        $clientes = Cliente::all(); // Mantener los clientes en el dropdown
        return view('ventascliente', compact('ventas', 'clientes'));
    }*/
    
}

