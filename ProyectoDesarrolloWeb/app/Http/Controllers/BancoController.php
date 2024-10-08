<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use Barryvdh\DomPDF\Facade\Pdf; // Importar la clase PDF
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index()
    {
        // Cargar todos los movimientos de la tabla bancos
        $movimientos = Banco::orderBy('fecha', 'desc')->get(); // Obtener movimientos por fecha
        
        return view('bancos', compact('movimientos')); // Pasar movimientos a la vista
    }

    public function generarPDF()
    {
        // Obtener los movimientos de la tabla bancos
        $movimientos = Banco::orderBy('fecha', 'desc')->get(); // Obtener movimientos por fecha

        // Contar el total de movimientos
        $totalMovimientos = $movimientos->count(); // Contar los movimientos

        // Generar el PDF usando la vista 'bancospdf'
        $pdf = Pdf::loadView('bancos_pdf', compact('movimientos', 'totalMovimientos'));

        // Descargar el PDF con el nombre "movimientos_bancos.pdf"
        return $pdf->download('movimientos_bancos.pdf');
    }
}