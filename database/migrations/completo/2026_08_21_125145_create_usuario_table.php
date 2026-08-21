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
            $table->string('tipo_doc', 20);
            $table->integer('id_tipo_persona')->nullable();
            $table->foreign('id_tipo_persona')->references('id_tipo_persona')->on('rol');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('sexo', 20)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->text('avatar')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('estado', 30)->nullable();
            $table->string('contrasena', 255)->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('nombre_artistico', 100)->nullable();
            $table->binary('representacion_legal');
            $table->binary('acta_nombramiento');
            $table->timestamp('verificar_email');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
