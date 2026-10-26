<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasIndex('resenas', ['nit'])) {
            Schema::table('resenas', function (Blueprint $table) {
                $table->index('nit', 'resenas_nit_index');
            });
        }

        Schema::table('reserva', function (Blueprint $table) {
            $table->index(['nit', 'fecha', 'estado'], 'reserva_nit_fecha_estado_index');
            $table->index('numero_doc', 'reserva_numero_doc_index');
        });

        Schema::table('subgenero', function (Blueprint $table) {
            $table->index('nit', 'subgenero_nit_index');
            $table->index('id_genero', 'subgenero_id_genero_index');
        });
    }

    public function down(): void
    {
        if (Schema::hasIndex('resenas', 'resenas_nit_index')) {
            Schema::table('resenas', function (Blueprint $table) {
                $table->dropIndex('resenas_nit_index');
            });
        }

        Schema::table('reserva', function (Blueprint $table) {
            $table->dropIndex('reserva_nit_fecha_estado_index');
            $table->dropIndex('reserva_numero_doc_index');
        });

        Schema::table('subgenero', function (Blueprint $table) {
            $table->dropIndex('subgenero_nit_index');
            $table->dropIndex('subgenero_id_genero_index');
        });
    }
};
