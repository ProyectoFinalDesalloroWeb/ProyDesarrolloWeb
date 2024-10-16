<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'tipo_movimiento', 'cantidad', 'fecha_movimiento'];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
}


