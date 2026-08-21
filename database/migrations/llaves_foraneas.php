<?php
$table->foreign('id_tipo_persona')->references('id_tipo_persona')->on('tipo_persona')->onDelete('set null');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');
                        $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');