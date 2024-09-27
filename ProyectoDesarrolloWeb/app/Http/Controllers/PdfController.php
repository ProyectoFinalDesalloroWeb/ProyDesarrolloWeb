<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function createPdf()
    {
        // Obtener todas las ventas con sus detalles
        $ventas = Ventas::with('detalleVentas')->get();

        // Crea una vista para el PDF
        $pdf = PDF::loadView('ventas_report', compact('ventas'));

        // Descarga el PDF
        return $pdf->download('ventas_report.pdf');
    }
}
