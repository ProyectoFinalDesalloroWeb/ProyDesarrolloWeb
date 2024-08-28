<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        //pagina de inicio
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
    public function show(Productos $productos)
    {
        //servira para obtener un registro de nuestra tabla
    }
    public function edit(Productos $productos)
    {
        //este metodo nos sirve para traer los datos que se van a editar
        //y los coloca en un formulario

        return "aqui se actualiza";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Productos $productos)
    {
        //este metodo actualiza los datos
    }
    public function destroy(Productos $productos)
    {
        //este metodo eliminado los datos
    }
}
