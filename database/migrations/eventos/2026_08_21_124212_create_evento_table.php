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

        Schema::create('evento', function (Blueprint $table) {
            $table->integer('id_evento')->primary()->autoIncrement();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('lugar', 200)->nullable();
            $table->string('estado', 30)->nullable();
            $table->string('nombre', 100)->nullable();
            $table->string('formato', 50)->nullable();
            $table->string('tematica', 100)->nullable();
            $table->string('tamano', 50)->nullable();
            $table->string('publico', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('nit')->nullable();
            $table->foreign('nit')->references('nit')->on('grupo_musical');
            $table->integer('id_instrumento');
            $table->foreign('id_instrumento')->references('id_instrumento')->on('musico_instrumento');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento');
    }
};
