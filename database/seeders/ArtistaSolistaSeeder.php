<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistaSolistaSeeder extends Seeder
{
    public function run(): void
    {
        $artistas = [
            ['numero_doc' => '1000000021', 'nombre' => 'Mateo', 'apellido' => 'Lopez', 'sexo' => 'M', 'nombre_artistico' => 'Mateo Luna', 'celular' => '3300000021'],
            ['numero_doc' => '1000000022', 'nombre' => 'Camila', 'apellido' => 'Suarez', 'sexo' => 'F', 'nombre_artistico' => 'Cami S', 'celular' => '3300000022'],
            ['numero_doc' => '1000000023', 'nombre' => 'Juan', 'apellido' => 'Pardo', 'sexo' => 'M', 'nombre_artistico' => 'Juan Pardo', 'celular' => '3300000023'],
            ['numero_doc' => '1000000024', 'nombre' => 'Isabella', 'apellido' => 'Mora', 'sexo' => 'F', 'nombre_artistico' => 'Isa Mora', 'celular' => '3300000024'],
            ['numero_doc' => '1000000025', 'nombre' => 'Nicolas', 'apellido' => 'Diaz', 'sexo' => 'M', 'nombre_artistico' => 'Nico Diaz', 'celular' => '3300000025'],
        ];

        $ahora = now();

        $artistas = array_map(fn (array $usuario) => array_merge($usuario, [
            'tipo_doc' => 'CC',
            'id_tipo_persona' => 2,
            'estado' => true,
            'fecha_registro' => $ahora->toDateString(),
            'created_at' => $ahora,
            'updated_at' => $ahora,
        ]), $artistas);

        DB::table('usuario')->upsert($artistas, ['numero_doc'], [
            'tipo_doc',
            'id_tipo_persona',
            'nombre',
            'apellido',
            'sexo',
            'celular',
            'estado',
            'fecha_registro',
            'nombre_artistico',
            'updated_at',
        ]);
    }
}
