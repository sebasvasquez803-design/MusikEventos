<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepresentanteLegalSeeder extends Seeder
{
    public function run(): void
    {
        $representantes = [
            ['numero_doc' => '1000000011', 'nombre' => 'Mariana', 'apellido' => 'Vargas', 'sexo' => 'F', 'celular' => '3200000011'],
            ['numero_doc' => '1000000012', 'nombre' => 'Jorge', 'apellido' => 'Ramirez', 'sexo' => 'M', 'celular' => '3200000012'],
            ['numero_doc' => '1000000013', 'nombre' => 'Diana', 'apellido' => 'Moreno', 'sexo' => 'F', 'celular' => '3200000013'],
            ['numero_doc' => '1000000014', 'nombre' => 'Felipe', 'apellido' => 'Navarro', 'sexo' => 'M', 'celular' => '3200000014'],
            ['numero_doc' => '1000000015', 'nombre' => 'Sofia', 'apellido' => 'Herrera', 'sexo' => 'F', 'celular' => '3200000015'],
        ];

        $ahora = now();

        $representantes = array_map(fn (array $usuario) => array_merge($usuario, [
            'tipo_doc' => 'CC',
            'id_tipo_persona' => 1,
            'estado' => true,
            'fecha_registro' => $ahora->toDateString(),
            'created_at' => $ahora,
            'updated_at' => $ahora,
        ]), $representantes);

        DB::table('usuario')->upsert($representantes, ['numero_doc'], [
            'tipo_doc',
            'id_tipo_persona',
            'nombre',
            'apellido',
            'sexo',
            'celular',
            'estado',
            'fecha_registro',
            'updated_at',
        ]);
    }
}
