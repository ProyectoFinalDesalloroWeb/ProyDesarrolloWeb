<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        // otros campos
        'nombre', 'descripcion', 'unidad_medida', 'cantidad', 'precio_unitario',
        'proveedor', 'fecha_adquisicion', 'fecha_expiracion', 
    ];
}



