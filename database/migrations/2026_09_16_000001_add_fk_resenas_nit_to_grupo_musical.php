<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Remove any reseñas that reference a non-existing grupo_musical.nit
        DB::table('resenas')
            ->whereNotNull('nit')
            ->whereNotIn('nit', function ($query) {
                $query->select('nit')->from('grupo_musical');
            })->delete();

        Schema::table('resenas', function (Blueprint $table) {
            // ensure column is nullable string(10) (it already should be)
            $table->string('nit', 10)->nullable()->change();
            $table->foreign('nit')
                ->references('nit')
                ->on('grupo_musical')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('resenas', function (Blueprint $table) {
            $table->dropForeign(['nit']);
        });
    }
};
