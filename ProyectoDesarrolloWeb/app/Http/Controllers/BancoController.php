<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use Barryvdh\DomPDF\Facade\Pdf; // Importar la clase PDF
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el tipo de movimiento desde la solicitud
        $tipo = $request->input('tipo');

        // Cargar movimientos según el tipo (ingreso, egreso o todos)
        if ($tipo === 'ingreso') {
            $movimientos = Banco::where('tipo', 'ingreso')->orderBy('fecha', 'desc')->get();
        } elseif ($tipo === 'egreso') {
            $movimientos = Banco::where('tipo', 'egreso')->orderBy('fecha', 'desc')->get();
        } else {
            $movimientos = Banco::orderBy('fecha', 'desc')->get(); // Obtener todos los movimientos
        }
        
        return view('bancos', compact('movimientos')); // Pasar movimientos a la vista
    }

    public function generarPDF()
    {
        // Obtener los movimientos de la tabla bancos
        $movimientos = Banco::orderBy('fecha', 'desc')->get(); // Obtener movimientos por fecha

        // Contar el total de movimientos
        $totalMovimientos = $movimientos->count(); // Contar los movimientos

        // Sumar ingresos y egresos
        $totalIngresos = $movimientos->where('tipo', 'ingreso')->sum('monto'); // Sumar los ingresos
        $totalEgresos = $movimientos->where('tipo', 'egreso')->sum('monto'); // Sumar los egresos

        // Generar el PDF usando la vista 'bancospdf'
        $pdf = Pdf::loadView('bancos_pdf', compact('movimientos', 'totalMovimientos', 'totalIngresos', 'totalEgresos'));

        // Descargar el PDF con el nombre "movimientos_bancos.pdf"
        return $pdf->download('movimientos_bancos.pdf');
    }
}