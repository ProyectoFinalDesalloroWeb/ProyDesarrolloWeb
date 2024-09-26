<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'Codigo',
        'Empresa_Cliente',
        'Correo_Electronico',
        'Estado',
        'Telefono',
        'Genero',
        'NIT',
        'Numero_DPI',
        'Nombre_Representante_legal',
        'Fecha_de_Registro',
        'Tipo_Cliente',
        'Departamento',
        'Municipio',
        'Completar_Direccion',
    ];

    // Relación con el modelo Venta (si aplica)
    public function ventas()
    {
        return $this->hasMany(Ventas::class, 'ClienteID');
    }
}
