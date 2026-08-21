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

        Schema::create('subgenero', function (Blueprint $table) {
            $table->integer('id_subgenero')->primary()->autoIncrement();
            $table->string('nombre_subgenero', 100)->nullable();
            $table->integer('id_genero')->nullable();
            $table->foreign('id_genero')->references('id_genero')->on('genero');
            $table->integer('numero_doc')->nullable();
            $table->integer('nit')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subgenero');
    }
};
