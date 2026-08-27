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
            $table->string('nombre_grupo', 50)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('avatar',200)->nullable();
            $table->text('descripcion',500)->nullable();
            $table->string('numero_doc', 10)->nullable();
            $table->decimal('precio_hora',12,5)->nullable();
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
