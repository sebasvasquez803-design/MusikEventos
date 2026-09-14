|<?php

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
        // Tabla utilizada por Laravel para almacenar la caché en SQLite.
        Schema::create('cache', function (Blueprint $table) {
            $table->id('id_cache');
            $table->mediumText('value');
            $table->bigInteger('expiration')->index();
        });

        // Bloqueos temporales utilizados por operaciones concurrentes de caché.
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->id('id_cache_locks');
            $table->string('owner');
            $table->bigInteger('expiration')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimina las tablas de caché al revertir la migración.
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
