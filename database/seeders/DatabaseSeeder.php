<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('tipo_persona')->insert([
            'id_tipo_persona' => 1,
            'nombre_tipo' => 'Representante_legal',
        ]);
        DB::table('tipo_persona')->insert([
            'id_tipo_persona' => 2,
            'nombre_tipo' => 'Solista_Artista',
        ]);
        DB::table('tipo_persona')->insert([
            'id_tipo_persona' => 3,
            'nombre_tipo' => 'Cliente',
        ]);
    }
    public function run2(): void
    {
        $administrador = users::create([
            'email' => 'mikan@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
