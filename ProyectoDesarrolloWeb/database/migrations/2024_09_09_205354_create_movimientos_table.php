<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->enum('tipo_movimiento', ['entrada', 'salida']);
            $table->decimal('cantidad', 8, 2);
            $table->dateTime('fecha_movimiento')->useCurrent();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}