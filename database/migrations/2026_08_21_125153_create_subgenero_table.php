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
            $table->integer('id_subgenero');
            $table->string('nombre_subgenero', 50)->nullable();
            $table->integer('id_genero')->nullable();
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
