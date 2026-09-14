<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Carga los tipos de persona base sin duplicarlos al repetir el seeder.
        // User::factory(10)->create();
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

        // Inserta o actualiza los grupos musicales iniciales usando el NIT como clave.
        DB::table('grupo_musical')->upsert([
            [
                'nit' => 900000001,
                'nombre_grupo' => 'Arcangel',
                'telefono' => '3000000001',
                'email' => 'arcangel@musikeventos.com',
                'avatar' => 'grupos/arcangel.jpg',
                'descripcion' => 'Una leyenda viva del genero urbano. Su flow inconfundible asegura un show de clase mundial.',
                'precio_hora' => 1500000,
            ],
            [
                'nit' => 900000002,
                'nombre_grupo' => 'LA 33',
                'telefono' => '3000000002',
                'email' => 'la33@musikeventos.com',
                'avatar' => 'grupos/la33.jpg',
                'descripcion' => 'Orquesta colombiana de salsa urbana con un repertorio lleno de energia.',
                'precio_hora' => 1800000,
            ],
            [
                'nit' => 900000003,
                'nombre_grupo' => 'Sebastian Yatra',
                'telefono' => '3000000003',
                'email' => 'yatra@musikeventos.com',
                'avatar' => 'grupos/yatra.jpg',
                'descripcion' => 'Cantante colombiano de pop y regueton con letras romanticas.',
                'precio_hora' => 2500000,
            ],
            [
                'nit' => 900000004,
                'nombre_grupo' => 'Manas Rufino',
                'telefono' => '3000000004',
                'email' => 'manas@musikeventos.com',
                'avatar' => 'grupos/manas.jpg',
                'descripcion' => 'Rapero y compositor colombiano, cofundador de Doble Porcion.',
                'precio_hora' => 1200000,
            ],
            [
                'nit' => 900000005,
                'nombre_grupo' => 'Grupo Firme',
                'telefono' => '3000000005',
                'email' => 'grupofirme@musikeventos.com',
                'avatar' => 'grupos/grupo_firme.jpg',
                'descripcion' => 'Agrupacion de musica regional mexicana reconocida por su energia en el escenario.',
                'precio_hora' => 2200000,
            ],
            [
                'nit' => 900000006,
                'nombre_grupo' => 'Metallica',
                'telefono' => '3000000006',
                'email' => 'metallica@musikeventos.com',
                'avatar' => 'grupos/metallica.jpg',
                'descripcion' => 'Banda de heavy metal con una trayectoria e influencia mundial.',
                'precio_hora' => 3000000,
            ],
        ], ['nit'], [
            'nombre_grupo',
            'telefono',
            'email',
            'avatar',
            'descripcion',
            'precio_hora',
        ]);

        // Crea o actualiza las cuentas administrativas del sistema.
        $this->run2();
    }

    public function run2(): void
    {
        // Credenciales iniciales de las cuentas autorizadas para administrar grupos.
        $administradores = [
            ['name' => 'Mican', 'email' => 'mican@gmail.com', 'password' => 'mican'],
            ['name' => 'JH', 'email' => 'jh@gmail.com', 'password' => 'jh'],
            ['name' => 'William', 'email' => 'william@gmail.com', 'password' => 'william'],
            ['name' => 'Sebastian', 'email' => 'sebastian@gmail.com', 'password' => 'voceragey'],
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
