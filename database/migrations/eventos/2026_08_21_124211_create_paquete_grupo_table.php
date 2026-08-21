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

        Schema::create('paquete_grupo', function (Blueprint $table) {
            $table->integer('id_paquete')->primary()->autoIncrement();
            $table->string('nombre_paquete', 100)->nullable();
            $table->text('contenido')->nullable();
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->string('duracion', 50)->nullable();
            $table->integer('nit')->nullable();
            $table->foreign('nit')->references('nit')->on('grupo_musical');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquete_grupo');
    }
};
