<?php

namespace App\Http\Controllers;

use App\Models\productosfinales;
use Illuminate\Http\Request;
use App\Models\Movimiento;

class ProductosfinalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agregarproducto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productos = new productosfinales();
        
        $productos->nombre = $request->post('nombre');
        $productos->descripcion = $request->post('descripcion');
        $productos->existencia = $request->post('existencia');
        $productos->precio_unitario = $request->post('precio_unitario');
        $productos->fecha_ingreso = $request->post('fecha_ingreso');
        $productos->fecha_vencimiento = $request->post('fecha_vencimiento');
        $productos->save();
        return redirect()->route("produccion")->with("success", "Agregado con éxito");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $productos = productosfinales::find($id);
        return view("eliminarproducto", compact('productos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productos = productosfinales::find($id);
        return view("actualizarproducto", compact('productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $productos = productosfinales::find($id);
        $cantidadAnterior = $productos->cantidad;
       
        $productos->nombre = $request->post('nombre');
        $productos->descripcion = $request->post('descripcion');
        $productos->existencia = $request->post('existencia');
        $productos->precio_unitario = $request->post('precio_unitario');
        $productos->fecha_ingreso = $request->post('fecha_ingreso');
        $productos->fecha_vencimiento = $request->post('fecha_vencimiento');
        $productos->save();
        if ($productos->cantidad > $cantidadAnterior) {
            // Calcula la diferencia de cantidad
            $diferencia = $productos->cantidad - $cantidadAnterior;
    
            // Registrar un movimiento de entrada
            Movimiento::create([
                'producto_id' => $productos->id,
                'tipo_movimiento' => 'entrada',
                'cantidad' => $diferencia,
                'fecha_movimiento' => now()
            ]);
        } elseif ($productos->cantidad < $cantidadAnterior) {
            // Si la cantidad disminuyó, puedes registrar una salida
            $diferencia = $cantidadAnterior - $productos->cantidad;
    
            // Registrar un movimiento de salida
            Movimiento::create([
                'producto_id' => $productos->id,
                'tipo_movimiento' => 'salida',
                'cantidad' => $diferencia,
                'fecha_movimiento' => now()
            ]);
        }
        return redirect()->route("productot")->with("success", "Actualizado con éxito");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $productos = productosfinales::find($id);
       $productos->delete();
       return redirect()->route("productot")->with("success","Eliminado con exito!");

        
    }
    public function productoterminado(){
        $datos = productosfinales::all();
        
        return view("productoterminado", compact('datos'));
    
    }
    public function obtenerStock($productoId)
    {
        // Buscar el producto por su ID
        $producto = productosfinales::find($productoId);

        // Verificar si el producto existe y devolver su stock (existencia)
        if ($producto) {
            return response()->json(['stock' => $producto->existencia]);
        } else {
            return response()->json(['stock' => 0, 'message' => 'Producto no encontrado.']);
        }
    }

}

