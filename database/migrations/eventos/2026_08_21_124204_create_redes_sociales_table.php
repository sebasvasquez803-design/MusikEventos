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
            $table->foreign('id_red_social')->references('id_red_social')->on('grupo_musical');
            $table->string('nombre_red', 50)->nullable();
            $table->text('url')->nullable();
            $table->integer('numero_doc')->nullable();
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
