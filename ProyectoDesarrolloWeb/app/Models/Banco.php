<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    // Especificar la tabla si es diferente al nombre del modelo
    protected $table = 'bancos'; 

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'fecha',       // Fecha de la transacción
        'descripcion', // Descripción de la transacción
        'tipo',        // Tipo de movimiento (ingreso, egreso)
        'monto',       // Monto de la transacción
        'saldo',       // Saldo después de la transacción
        // Agrega otros campos según sea necesario
    ];

    // Definir la relación con Productos
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'materia_prima_id');
    }

    // Definir la relación con DetalleVentas
    public function detalleVenta()
    {
        return $this->belongsTo(DetalleVentas::class, 'venta_id');
    }
}
