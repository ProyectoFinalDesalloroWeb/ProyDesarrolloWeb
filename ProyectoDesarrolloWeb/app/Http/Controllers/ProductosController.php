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
        //el formulario donde nosotros agregamos datos

        return "aqui puedes agregar";
    }

    public function store(Request $request)
    {
        //sirve para guardar datos en la BD
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
