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

        Schema::create('reserva', function (Blueprint $table) {
            $table->id('id_reserva');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('direccion', 60)->nullable();
            $table->decimal('valor', 10, 5)->nullable();
            $table->string('estado',)->nullable()->default(true);
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
        Schema::dropIfExists('reserva');
    }
};
