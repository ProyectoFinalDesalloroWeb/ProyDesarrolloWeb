<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // Identificador único auto incremental
            $table->string('nombre'); // Nombre de la materia prima
            $table->text('descripcion'); // Descripción detallada
            $table->enum('unidad_medida', ['kilogramos', 'gramos', 'litros', 'mililitros']); // Lista de unidades de medida
            $table->decimal('cantidad', 8, 2); // Cantidad de la materia prima
            $table->decimal('precio_unitario', 8, 2); // Costo por unidad
            $table->string('proveedor'); // Nombre o identificador del proveedor
            $table->date('fecha_adquisicion'); // Fecha de adquisición
            $table->date('fecha_expiracion')->nullable(); // Fecha de expiración, si aplica
            $table->enum('estado', ['activa', 'inactiva']); // Estado de la materia prima
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
