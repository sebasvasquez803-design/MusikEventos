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

        Schema::create('resenas', function (Blueprint $table) {
            $table->integer('id_resena')->primary()->autoIncrement();
            $table->integer('numero_estrellas')->nullable();
            $table->text('comentario')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('numero_doc')->nullable();
            $table->foreign('numero_doc')->references('numero_doc')->on('usuario');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
