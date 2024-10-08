<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('descripcion');
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->decimal('monto', 10, 2);
            $table->decimal('saldo', 10, 2);
            $table->foreignId('materia_prima_id')->nullable()->constrained('productos')->onDelete('cascade');
            $table->foreignId('venta_id')->nullable()->constrained('detalle_ventas')->onDelete('cascade');
            $table->timestamps();
        });

        // Insertar el monto inicial
        DB::table('bancos')->insert([
            'descripcion' => 'Monto inicial',
            'tipo' => 'ingreso',
            'monto' => 100000.00, // Cambia este valor según sea necesario
            'saldo' => 100000.00, // Cambia este valor según sea necesario
            'fecha' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bancos');
    }
}
