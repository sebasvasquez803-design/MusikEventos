<?php
    $table->foreign('id_tipo_persona')->references('id_tipo_persona')->on('tipo_persona')->onDelete('set null');
    $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
    $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
    $table->foreign('id_experiencia_laboral')->references('id_experiencia_laboral')->on('experiencia_laboral')->onDelete('cascade');