<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movimiento;

class ProductosController extends Controller
{
    public function index(Request $request)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Construye la consulta base
        $query = Productos::query();

        // Aplica filtro de búsqueda si se proporciona
        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        // Obtiene los resultados paginados
        $datos = $query->OrderBy('fecha_expiracion', 'asc')->paginate(10); // Paginación con 10 registros por página

        // Devuelve la vista con los datos paginados
        return view('inicio', compact('datos'));
    }

    public function create()
    {
        //formulario donde nosotros agregamos datos
        return view('agregar');
    }

    //REGISTRAR DATOS EN LA BD
    public function store(Request $request)
    {
        $productos = new Productos();
        $productos->nombre = $request->post('nombre');
        $productos->descripcion = $request->post('descripcion');
        $productos->unidad_medida = $request->post('unidad_medida');
        $productos->cantidad = $request->post('cantidad');
        $productos->precio_unitario = $request->post('precio_unitario');
        $productos->proveedor = $request->post('proveedor');
        $productos->fecha_adquisicion = $request->post('fecha_adquisicion');
        $productos->fecha_expiracion = $request->post('fecha_expiracion');
        $productos->save();
    
        // Registrar movimiento de entrada
        Movimiento::create([
            'producto_id' => $productos->id,
            'tipo_movimiento' => 'entrada',
            'cantidad' => $productos->cantidad,
            'fecha_movimiento' => now(),
        ]);
    
        return redirect()->route('productos.index')->with("success", "Agregado con éxito!");
    }

    
    public function show($id)
    {
        //servira para obtener un registro de nuestra tabla
        $productos = Productos::find($id);

        return view('eliminar', compact('productos'));
    }
    public function edit($id)
    {
        //este metodo nos sirve para traer los datos que se van a editar
        //y los coloca en un formulario

        $productos = Productos::find($id);
        return view("actualizar", compact('productos'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'unidad_medida' => 'required|string',
            'cantidad' => 'required|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'proveedor' => 'required|string|max:255',
            'fecha_adquisicion' => 'required|date',
            'fecha_expiracion' => 'nullable|date',
        ]);
    
        // Encuentra el producto por su id
        $producto = Productos::find($id);
    
        // Guarda la cantidad actual antes de actualizar
        $cantidadAnterior = $producto->cantidad;
    
        // Actualiza los campos del producto
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->unidad_medida = $request->unidad_medida;
        $producto->cantidad = $request->cantidad;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->proveedor = $request->proveedor;
        $producto->fecha_adquisicion = $request->fecha_adquisicion;
        $producto->fecha_expiracion = $request->fecha_expiracion;
        $producto->save();
    
        // Verifica si la nueva cantidad es mayor a la cantidad anterior
        if ($producto->cantidad > $cantidadAnterior) {
            // Calcula la diferencia de cantidad
            $diferencia = $producto->cantidad - $cantidadAnterior;
    
            // Registrar un movimiento de entrada
            Movimiento::create([
                'producto_id' => $producto->id,
                'tipo_movimiento' => 'entrada',
                'cantidad' => $diferencia,
                'fecha_movimiento' => now()
            ]);
        } elseif ($producto->cantidad < $cantidadAnterior) {
            // Si la cantidad disminuyó, registrar un movimiento de salida
            $diferencia = $cantidadAnterior - $producto->cantidad;
    
            // Registrar un movimiento de salida
            Movimiento::create([
                'producto_id' => $producto->id,
                'tipo_movimiento' => 'salida',
                'cantidad' => $diferencia,
                'fecha_movimiento' => now()
            ]);
        }
    
        // Redirigir con mensaje de éxito
        return redirect()->route('productos.index')->with("success", "Producto actualizado con éxito!");
    }




public function destroy($id)
{
    // Busca el producto por ID
    $producto = Productos::find($id);
    
    // Usar soft delete en lugar de eliminar físicamente
    if ($producto) {
        $producto->delete(); // Soft delete
        return redirect()->route('productos.index')->with("success", "Producto eliminado con éxito!");
    }

    return redirect()->route('productos.index')->with("error", "Producto no encontrado.");
}

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function mostrarRegistro()
    {
        // Usar withTrashed() para incluir productos que han sido eliminados con soft delete
        $movimientos = Movimiento::with(['producto' => function ($query) {
            $query->withTrashed();
        }])->get();
    
        return view('registro', compact('movimientos'));
    }

public function mostrarProduccion()
{
    // Obtener todos los productos disponibles para la producción
    $productos = Productos::all();
    
    // Retornar la vista de producción y pasar los productos
    return view('produccion', compact('productos'));
}

public function producir(Request $request)
{
    // Obtén los arrays de productos y cantidades del formulario
    $producto_ids = $request->producto_id;
    $cantidades = $request->cantidad;

    // Recorre cada producto y cantidad seleccionada
    foreach ($producto_ids as $index => $producto_id) {
        // Busca un producto individual
        $producto = Productos::find($producto_id);

        // Verifica que el producto se haya encontrado
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        $cantidad_usada = $cantidades[$index];

        // Verifica si hay suficiente inventario para cada producto
        if ($producto->cantidad < $cantidad_usada) {
            return redirect()->back()->with('error', 'Cantidad insuficiente en inventario para ' . $producto->nombre);
        }

        // Descontar del inventario
        $producto->cantidad -= $cantidad_usada;
        $producto->save();

        // Registrar movimiento de salida
        Movimiento::create([
            'producto_id' => $producto->id,
            'tipo_movimiento' => 'salida',
            'cantidad' => $cantidad_usada,
            'fecha_movimiento' => now(),
        ]);
    }

    return redirect()->route('productot')->with('success', 'Dulce producido y materias primas descontadas del inventario.');
}


}
