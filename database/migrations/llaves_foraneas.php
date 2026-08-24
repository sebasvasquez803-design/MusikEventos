<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    // seccion de usuarios
    //$table->foreign('id_tipo_persona')->references('id_tipo_persona')->on('tipo_persona')->onDelete('set null');
    //$table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
    //$table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
    //$table->foreign('id_experiencia_laboral')->references('id_experiencia_laboral')->on('experiencia_laboral')->onDelete('cascade');

    // para lo de llave primaria e incrementaer
    //primary()->autoIncrement();

    // seccion de pagos
    //$table->foreign('id_reserva')->references('id_reserva')->on('detalle_pago');
    //$table->foreign('numero_serie')->references('numero_serie')->on('detalle_pago');

    // seccion de eventos
    //$table->foreign('numero_doc')->references('numero_doc')->on('usuario');
    //$table->foreign('numero_doc')->references('numero_doc')->on('usuario');
    //$table->foreign('numero_doc')->references('numero_doc')->on('usuario');
    //$table->foreign('numero_doc')->references('numero_doc')->on('usuario');
    //$table->foreign('numero_doc')->references('numero_doc')->on('usuario');
    //$table->foreign('nit')->references('nit')->on('grupo_musical');
    //$table->foreign('nit')->references('nit')->on('grupo_musical');
    //$table->foreign('id_genero')->references('id_genero')->on('genero');
    //$table->foreign('numero_doc')->references('numero_doc')->on('usuario');
    //$table->foreign('nit')->references('nit')->on('grupo_musical');
    }
};
