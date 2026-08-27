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
            $table->increments('id_resena');
            $table->integer('numero_estrellas')->nullable();
            $table->text('comentario',300)->nullable();
            $table->date('fecha')->nullable();
            $table->string('numero_doc', 10)->nullable();
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
