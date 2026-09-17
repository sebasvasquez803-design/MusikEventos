<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_persona')->updateOrInsert([
            'id_tipo_persona' => 1,
        ], [
            'nombre_tipo' => 'Representante_legal',
        ]);

        DB::table('tipo_persona')->updateOrInsert([
            'id_tipo_persona' => 2,
        ], [
            'nombre_tipo' => 'Solista_Artista',
        ]);

        DB::table('tipo_persona')->updateOrInsert([
            'id_tipo_persona' => 3,
        ], [
            'nombre_tipo' => 'Cliente',
        ]);
    }
}
