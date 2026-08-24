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
            $table->integer('id_paquete');
            $table->string('nombre_paquete', 50)->nullable();
            $table->text('contenido',300)->nullable();
            $table->text('descripcion',500)->nullable();
            $table->decimal('precio', 10, 5)->nullable();
            $table->time('duracion', )->nullable();
            $table->integer('nit')->nullable();
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
