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

        Schema::create('musico_instrumento', function (Blueprint $table) {
            $table->integer('numero_doc')->primary();
            $table->integer('id_instrumento')->primary();
            $table->foreign('id_instrumento')->references('id_instrumento')->on('instrumento');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musico_instrumento');
    }
};
