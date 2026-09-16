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
        Schema::table('resenas', function (Blueprint $table) {
            $table->string('nit', 10)->nullable()->after('numero_doc');
            $table->string('nombre_usuario', 80)->nullable()->after('nit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resenas', function (Blueprint $table) {
            $table->dropColumn(['nit', 'nombre_usuario']);
        });
    }
};
