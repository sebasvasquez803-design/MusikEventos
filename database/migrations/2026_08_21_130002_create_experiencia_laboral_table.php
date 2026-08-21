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
            $table->unsignedBigInteger('id_persona');
            $table->integer('anio_inicio')->nullable();
            $table->integer('anio_fin')->nullable();
            $table->integer('eventos_realizados')->nullable()->default(0);
            $table->string('titulo_obtenido', 100)->nullable();
            $table->text('habilidades_principales')->nullable();
            $table->string('academia_formacion', 100)->nullable();
            $table->string('estudios', 100)->nullable();
            $table->string('publico_privado', 20)->nullable();
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
