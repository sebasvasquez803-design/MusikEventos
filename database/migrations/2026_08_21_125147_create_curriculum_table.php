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
            $table->integer('id_experiencia');
            $table->integer('anio_inicio')->nullable();
            $table->integer('anio_fin')->nullable();
            $table->integer('eventos_realizados')->nullable();
            $table->blob('titulo_obtenido')->nullable();
            $table->text('habilidades_principales')->nullable();
            $table->string('academia_formacion',50)->nullable();
            $table->string('estudios',100)->nullable();
            $table->string('publico_privado', 20)->nullable();
            $table->integer('numero_doc')->nullable();
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
