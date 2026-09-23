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
        Schema::table('grupo_musical', function (Blueprint $table) {
            $table->unsignedBigInteger('id_subgenero')->nullable()->after('nit');
        });

        Schema::table('grupo_musical', function (Blueprint $table) {
            $table->foreign('id_subgenero')
                ->references('id_subgenero')
                ->on('subgenero')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupo_musical', function (Blueprint $table) {
            $table->dropForeign(['id_subgenero']);
            $table->dropColumn('id_subgenero');
        });
    }
};
