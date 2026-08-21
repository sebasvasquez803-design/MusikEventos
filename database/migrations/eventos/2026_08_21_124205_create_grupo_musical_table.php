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

        Schema::create('grupo_musical', function (Blueprint $table) {
            $table->integer('nit')->primary();
            $table->string('nombre_grupo', 100)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('avatar')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('numero_doc')->nullable();
            $table->integer('id_subgenero');
            $table->foreign('id_subgenero')->references('id_subgenero')->on('subgenero');
            $table->integer('id_red_social');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_musical');
    }
};
