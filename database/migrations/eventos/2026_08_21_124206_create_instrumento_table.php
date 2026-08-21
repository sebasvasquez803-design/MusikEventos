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

        Schema::create('instrumento', function (Blueprint $table) {
            $table->integer('id_instrumento')->primary()->autoIncrement();
            $table->string('nombre_instrumento', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->text('foto')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumento');
    }
};
