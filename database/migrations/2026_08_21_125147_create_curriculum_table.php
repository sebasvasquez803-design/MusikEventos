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
            $table->id('id_experiencia');
            $table->integer('anio_inicio')->nullable();
            $table->integer('anio_fin')->nullable();
            $table->integer('eventos_realizados')->nullable();
            $table->text('titulo_obtenido', 300)->nullable();
            $table->string('habilidades_principales', 150)->nullable();
            $table->string('academia_formacion', 50)->nullable();
            $table->string('estudios', 100)->nullable();
            $table->string('publico_privado', 20)->nullable();
            $table->string('numero_doc', 10)->nullable();
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
