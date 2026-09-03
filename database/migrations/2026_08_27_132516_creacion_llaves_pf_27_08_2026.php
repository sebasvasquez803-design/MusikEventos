<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Relaciones de Usuario y Tipo Persona
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('id_tipo_persona')
                ->references('id_tipo_persona')
                ->on('tipo_persona')
                ->nullOnDelete();
        });

        // 2. Relaciones directas con Usuario
        Schema::table('experiencia_laboral', function (Blueprint $table) {
            $table->foreign('numero_doc')
                ->references('numero_doc')
                ->on('usuario')
                ->cascadeOnDelete();
        });

        foreach (['redes_sociales', 'curriculum', 'resenas', 'grupo_musical'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->foreign('numero_doc')
                    ->references('numero_doc')
                    ->on('usuario')
                    ->nullOnDelete();
            });
        }

        // 3. Relaciones de Reserva (Agrupadas)
        Schema::table('reserva', function (Blueprint $table) {
            $table->foreign('numero_doc')
                ->references('numero_doc')
                ->on('usuario')
                ->nullOnDelete();

            $table->foreign('nit')
                ->references('nit')
                ->on('grupo_musical')
                ->nullOnDelete();
        });

        // 4. Flujo de Pago: Reserva -> Detalle Pago -> Factura
        Schema::table('detalle_pago', function (Blueprint $table) {
            $table->unsignedInteger('id_reserva')->nullable()->change();
            $table->foreign('id_reserva')
                ->references('id_reserva')
                ->on('reserva')
                ->nullOnDelete();
        });

        Schema::table('factura', function (Blueprint $table) {
            $table->foreign('numero_serie')
                ->references('numero_serie')
                ->on('detalle_pago')
                ->nullOnDelete();
        });

        // 5. Otras tablas dependientes
        Schema::table('subgenero', function (Blueprint $table) {
            $table->foreign('id_genero')
                ->references('id_genero')
                ->on('genero')
                ->nullOnDelete();

            $table->foreign('numero_doc')
                ->references('numero_doc')
                ->on('usuario')
                ->nullOnDelete();

            $table->foreign('nit')
                ->references('nit')
                ->on('grupo_musical')
                ->nullOnDelete();
        });

        Schema::table('paquete_grupo', function (Blueprint $table) {
            $table->foreign('nit')
                ->references('nit')
                ->on('grupo_musical')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        // Recuerda que es buena práctica añadir los dropForeign aquí por si necesitas revertir la migración
    }
};
