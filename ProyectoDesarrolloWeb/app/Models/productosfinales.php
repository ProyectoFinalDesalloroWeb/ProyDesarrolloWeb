<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productosfinales extends Model
{
    use HasFactory;
    protected $fillable = [
        // otros campos
        'nombre', 'descripcion', 'existencia', 'precio_unitario',
        'fecha_ingreso', 'fecha_expiracion',
    ];
}
