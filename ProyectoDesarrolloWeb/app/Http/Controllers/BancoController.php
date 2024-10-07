<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index()
    {
        // Cargar todos los movimientos de la tabla bancos
        $movimientos = Banco::orderBy('fecha', 'desc')->get(); // Obtener movimientos por fecha
        
        return view('bancos', compact('movimientos')); // Pasar movimientos a la vista
    }

    // Otros métodos del controlador...
}
