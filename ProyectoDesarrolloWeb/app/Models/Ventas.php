<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    // Define la tabla asociada, si no sigue la convención
    protected $table = 'ventas';

    protected $fillable = ['cliente_id', 'fecha_venta'];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVentas::class);
    }
    use HasFactory;

    // Relación muchos a muchos con productosfinales usando una tabla intermedia
    public function productos()
    {
        // Asumimos que la tabla intermedia se llama "detalle_ventas"
        return $this->belongsToMany(productosfinales::class, 'detalle_ventas', 'venta_id', 'producto_id')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal');
    }
    
}

