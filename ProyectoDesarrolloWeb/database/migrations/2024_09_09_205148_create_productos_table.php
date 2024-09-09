<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->enum('unidad_medida', ['kilogramos', 'gramos', 'litros', 'mililitros']);
            $table->decimal('cantidad', 8, 2);
            $table->decimal('precio_unitario', 8, 2);
            $table->string('proveedor');
            $table->date('fecha_adquisicion');
            $table->date('fecha_expiracion')->nullable();
            $table->softDeletes(); // Agrega el campo deleted_at
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};

