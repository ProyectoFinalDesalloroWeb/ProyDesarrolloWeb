<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\productosfinales;
use App\Models\Ventas;
use App\Models\DetalleVentas;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Producto;
use App\Models\Banco; // Línea añadida: Importar el modelo Banco

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

        // Inicializar el total de la venta
        $totalVenta = 0; // Línea añadida: Inicializa el total de la venta

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

            // Acumular el subtotal al total de la venta
            $totalVenta += $producto['cantidad'] * $productoFinal->precio_unitario; // Línea añadida: Acumula el subtotal
        }

        // Registrar ingreso en la tabla bancos
        Banco::create([ // Línea añadida: Registrar ingreso en la tabla bancos
            'fecha' => now(),
            'descripcion' => 'Ingreso por venta', // Línea añadida: Descripción del ingreso
            'tipo' => 'ingreso', // Línea añadida: Tipo de movimiento
            'monto' => $totalVenta, // Línea añadida: Monto del ingreso
            'saldo' => $this->calcularNuevoSaldo($totalVenta), // Línea añadida: Lógica para calcular el nuevo saldo
        ]);

        // Redirigir con un mensaje de éxito después de guardar
        return redirect()->route('ventacliente')->with('success', 'Venta guardada correctamente.');
    }

    // Método para calcular el nuevo saldo
    public function calcularNuevoSaldo($monto)
    {
        // Obtener el último saldo de la tabla bancos
        $ultimoRegistro = Banco::orderBy('fecha', 'desc')->first(); // Línea añadida: Obtener el último registro de bancos

        // Si no hay registros, el saldo inicial es 0
        $saldoActual = $ultimoRegistro ? $ultimoRegistro->saldo : 0; // Línea añadida: Definir el saldo actual

        // Calcular el nuevo saldo
        return $saldoActual + $monto; // Línea añadida: Sumar el monto al saldo actual
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

    public function mostrarHistorialVentas()
    {
        // Traer todas las ventas con la relación de cliente y productos
        $ventas = Ventas::with('cliente', 'productos')->get();
        
        // Calcular el total de cada venta
        foreach ($ventas as $venta) {
            $venta->total_venta = 0; // Inicializar el total de la venta
            foreach ($venta->productos as $producto) {
                $venta->total_venta += $producto->pivot->subtotal; // Sumar el subtotal de cada producto
            }
        }
        // Retornar la vista y pasar las ventas
        return view('historialventas', compact('ventas'));
    }

    public function buscarVentas(Request $request)
    {
        // Obtener el query de búsqueda
        $query = $request->input('query');
    
        // Filtrar ventas por código de cliente o nombre de cliente
        $ventas = Ventas::with('cliente', 'productos') // Incluye la relación de productos
            ->whereHas('cliente', function ($q) use ($query) {
                $q->where('Codigo', 'like', "%$query%")
                  ->orWhere('Empresa_Cliente', 'like', "%$query%");
            })
            ->get();
    
        // Calcular el total de cada venta
        foreach ($ventas as $venta) {
            $venta->total_venta = 0; // Inicializar el total de la venta
            foreach ($venta->productos as $producto) {
                $venta->total_venta += $producto->pivot->subtotal; // Sumar el subtotal de cada producto
            }
        }
    
        return view('historialventas', compact('ventas'));
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
