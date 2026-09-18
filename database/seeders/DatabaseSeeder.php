<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        // Credenciales iniciales de las cuentas autorizadas para administrar grupos.
        $administradores = [
            ['name' => 'Mican', 'email' => 'mican@gmail.com', 'password' => 'mican'],
            ['name' => 'JH', 'email' => 'jh@gmail.com', 'password' => 'jh'],
            ['name' => 'William', 'email' => 'william@gmail.com', 'password' => 'william'],
            ['name' => 'Sebastian', 'email' => 'sebastian@gmail.com', 'password' => 'elmejor'],
        ];

        // updateOrCreate permite ejecutar el seeder varias veces sin duplicar usuarios.
        foreach ($administradores as $administrador) {
            User::updateOrCreate(
                ['email' => $administrador['email']],
                [
                    'name' => $administrador['name'],
                    'password' => Hash::make($administrador['password']),
                ],
            );
        }
    }
}
