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
        Schema::create('experiencia_laboral', function (Blueprint $table) {
            $table->id('id_experiencia');
            $table->string('numero_doc', 10)->nullable();
            $table->timestamp('anio_inicio')->nullable();
            $table->integer('anio_fin')->nullable();
            $table->text('titulo_obtenido')->nullable();
            $table->string('habilidades_principales', 150)->nullable();
            $table->string('academia_formacion', 50)->nullable();
            $table->string('estudios',150)->nullable();
            $table->boolean('publico_privado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiencia_laboral');
    }
};
