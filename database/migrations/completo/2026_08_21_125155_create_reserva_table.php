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
        Schema::disableForeignKeyConstraints();

        Schema::create('reserva', function (Blueprint $table) {
            $table->integer('id_reserva')->primary()->autoIncrement();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('direccion', 200)->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->string('estado', 30)->nullable();
            $table->integer('numero_doc')->nullable();
            $table->foreign('numero_doc')->references('numero_doc')->on('usuario');
            $table->integer('nit')->nullable();
            $table->foreign('nit')->references('nit')->on('grupo_musical');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};
