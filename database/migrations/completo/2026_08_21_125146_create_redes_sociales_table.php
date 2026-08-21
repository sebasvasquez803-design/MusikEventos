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

        Schema::create('redes_sociales', function (Blueprint $table) {
            $table->integer('id_red_social')->primary()->autoIncrement();
            $table->string('nombre_red', 50)->nullable();
            $table->text('url')->nullable();
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
        Schema::dropIfExists('redes_sociales');
    }
};
