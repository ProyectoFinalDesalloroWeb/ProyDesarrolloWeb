<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductosController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirige al login si el usuario no está autenticado
        }

        // Página de inicio si el usuario está autenticado
        $datos = Productos::all();
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
        $productos->estado = $request->post('estado');
        $productos->save();

        return redirect()->route('productos.index')->with("success", "Agregado con exito!");
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
        //este metodo actualiza los datos
        $productos = Productos::find($id);
        $productos->nombre = $request->post('nombre');
        $productos->descripcion = $request->post('descripcion');
        $productos->unidad_medida = $request->post('unidad_medida');
        $productos->cantidad = $request->post('cantidad');
        $productos->precio_unitario = $request->post('precio_unitario');
        $productos->proveedor = $request->post('proveedor');
        $productos->fecha_adquisicion = $request->post('fecha_adquisicion');
        $productos->fecha_expiracion = $request->post('fecha_expiracion');
        $productos->estado = $request->post('estado');
        $productos->save();

        return redirect()->route('productos.index')->with("success", "Actualizado con exito!");
    }
    public function destroy($id)
    {
        //este metodo eliminado los datos
        $productos = Productos::find($id);
        $productos->delete();
        return redirect()->route('productos.index')->with("success", "Eliminado con exito!");
    }
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
}
