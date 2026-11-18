<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes_integrante', function (Blueprint $table) {
            $table->id();
            $table->string('nit', 10);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('numero_doc', 10)->nullable();
            $table->string('rol', 50);
            $table->string('instrumento', 50);
            $table->text('mensaje')->nullable();
            $table->string('estado', 20)->default('pendiente');
            $table->timestamps();

            $table->unique(['nit', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes_integrante');
    }
};
