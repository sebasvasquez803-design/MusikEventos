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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('tipo_doc', 5)->nullable();
            $table->string('numero_doc', 10)->unique()->nullable();
            $table->unsignedBigInteger('id_tipo_persona')->nullable();
            $table->string('nombre', 25)->nullable();
            $table->string('apellido', 25)->nullable();
            $table->string('sexo', 1)->nullable();
            $table->string('celular', 10)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->blob('avatar')->nullable();
            $table->boolean('estado')->nullable()->default(true);
            $table->date('fecha_registro')->nullable();
            $table->string('nombre_artistico', 25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona');
    }
};
