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

        Schema::create('categoria_instrumento', function (Blueprint $table) {
            $table->integer('id_categoria')->primary()->autoIncrement();
            $table->string('tipo_instrumento', 100)->nullable();
            $table->string('nombre_marca', 100)->nullable();
            $table->string('nombre_modelo', 100)->nullable();
            $table->integer('id_instrumento')->nullable();
            $table->foreign('id_instrumento')->references('id_instrumento')->on('instrumento');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_instrumento');
    }
};
