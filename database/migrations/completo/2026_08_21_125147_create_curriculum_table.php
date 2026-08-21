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

        Schema::create('curriculum', function (Blueprint $table) {
            $table->integer('id_experiencia')->primary()->autoIncrement();
            $table->integer('anio_inicio')->nullable();
            $table->integer('anio_fin')->nullable();
            $table->integer('eventos_realizados')->nullable();
            $table->string('titulo_obtenido', 100)->nullable();
            $table->text('habilidades_principales')->nullable();
            $table->string('academia_formacion', 100)->nullable();
            $table->string('estudios', 100)->nullable();
            $table->string('publico_privado', 20)->nullable();
            $table->integer('numero_doc')->nullable();
            $table->foreign('numero_doc')->references('numero_doc')->on('usuario');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum');
    }
};
