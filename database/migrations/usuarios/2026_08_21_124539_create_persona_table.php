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

        Schema::create('usuario', function (Blueprint $table) {
            $table->integer('numero_doc')->primary();
            $table->foreign('numero_doc')->references('numero_doc')->on('experiencia_laboral');
            $table->string('tipo_doc', 10);
            $table->integer('id_tipo_persona')->nullable();
            $table->foreign('id_tipo_persona')->references('id_tipo_persona')->on('tipo_persona');
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('sexo', 1)->nullable();
            $table->string('celular', 10)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->text('avatar')->nullable();
            $table->string('email', 80)->nullable();
            $table->string('estado', 30)->nullable();
            $table->string('contrasena', 30)->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('nombre_artistico', 100)->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona');
    }
};
