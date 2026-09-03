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
            $table->id('id_subgenero');
            $table->string('nombre_subgenero', 50)->nullable();
            $table->unsignedInteger('id_genero')->nullable();
            $table->string('numero_doc', 10)->nullable();
            $table->string('nit', 10)->nullable();
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
