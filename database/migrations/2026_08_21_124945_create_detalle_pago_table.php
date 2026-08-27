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
        Schema::create('detalle_pago', function (Blueprint $table) {
            $table->increments('numero_serie');
            $table->timestamp('fecha_pago')->nullable();
            $table->decimal('precio_total', 10, 5)->nullable();
            $table->decimal('precio_con_iva', 10, 5)->nullable();
            $table->decimal('descuento', 10, 5)->nullable();
            $table->string('estado_pago', 15)->nullable()->default(true) ;
            $table->integer('id_cliente')->nullable();
            $table->integer('id_reserva')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pago');
    }
};
