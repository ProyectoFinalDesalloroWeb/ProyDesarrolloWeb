<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    use HasFactory;

    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal'];


    public function venta()
    {
        return $this->belongsTo(Ventas::class);
    }

    public function producto()
    {
        return $this->belongsTo(productosfinales::class, 'producto_id');
    }
}
