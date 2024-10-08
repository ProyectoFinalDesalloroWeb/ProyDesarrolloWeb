<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use Barryvdh\DomPDF\Facade\Pdf; // Importar la clase PDF
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el tipo de movimiento y fecha desde la solicitud
        $tipo = $request->input('tipo');
        $fecha = $request->input('fecha');

        // Inicializar la consulta
        $query = Banco::query();

        // Filtrar por tipo (ingreso o egreso)
        if ($tipo === 'ingreso') {
            $query->where('tipo', 'ingreso');
        } elseif ($tipo === 'egreso') {
            $query->where('tipo', 'egreso');
        }

        // Filtrar por fecha si se proporciona
        if ($fecha) {
            $query->whereDate('fecha', $fecha); // Filtrar por fecha
        }

        // Obtener movimientos según los filtros aplicados
        $movimientos = $query->orderBy('fecha', 'desc')->get(); 

        // Calcular totales de ingresos y egresos según los filtros
        $totalIngresos = Banco::where('tipo', 'ingreso')
            ->when($fecha, function($query) use ($fecha) {
                return $query->whereDate('fecha', $fecha); // Filtrar por fecha
            })
            ->sum('monto'); // Sumar ingresos

        $totalEgresos = Banco::where('tipo', 'egreso')
            ->when($fecha, function($query) use ($fecha) {
                return $query->whereDate('fecha', $fecha); // Filtrar por fecha
            })
            ->sum('monto'); // Sumar egresos

        return view('bancos', compact('movimientos', 'totalIngresos', 'totalEgresos')); // Pasar movimientos y totales a la vista
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

        // Generar el PDF usando la vista 'bancos_pdf'
        $pdf = Pdf::loadView('bancos_pdf', compact('movimientos', 'totalMovimientos', 'totalIngresos', 'totalEgresos'));

        // Descargar el PDF con el nombre "movimientos_bancos.pdf"
        return $pdf->download('movimientos_bancos.pdf');
    }
}
