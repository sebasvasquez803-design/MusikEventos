<?php

namespace Database\Seeders;

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

        // DB::table('grupo_musical')->insert([
        //     [
        //         'nit' => 900000001,
        //         'nombre_grupo' => 'Arcangel',
        //         'telefono' => '3000000001',
        //         'email' => 'arcangel@musikeventos.com',
        //         'avatar' => 'storage/app/public/grupos/arcangel.jpg',
        //         'descripcion' => 'Una leyenda viva del genero urbano. Su flow inconfundible asegura un show de clase mundial.',
        //         'precio_hora' => 1500000,
        //     ],
        //     [
        //         'nit' => 900000002,
        //         'nombre_grupo' => 'LA 33',
        //         'telefono' => '3000000002',
        //         'email' => 'la33@musikeventos.com',
        //         'avatar' => 'storage/app/public/grupos/la33.jpeg',
        //         'descripcion' => 'Orquesta colombiana de salsa urbana con un repertorio lleno de energia.',
        //         'precio_hora' => 1800000,
        //     ],
        //     [
        //         'nit' => 900000003,
        //         'nombre_grupo' => 'Sebastian Yatra',
        //         'telefono' => '3000000003',
        //         'email' => 'yatra@musikeventos.com',
        //         'avatar' => 'storage/app/public/grupos/yatra.jpeg',
        //         'descripcion' => 'Cantante colombiano de pop y regueton con letras romanticas.',
        //         'precio_hora' => 2500000,
        //     ],
        //     [
        //         'nit' => 900000004,
        //         'nombre_grupo' => 'Manas Rufino',
        //         'telefono' => '3000000004',
        //         'email' => 'manas@musikeventos.com',
        //         'avatar' => 'storage/app/public/grupos/manas.jpeg',
        //             'descripcion' => 'Rapero y compositor colombiano, cofundador de Doble Porcion.',
        //         'precio_hora' => 1200000,
        //     ],
        //     [
        //         'nit' => 900000005,
        //         'nombre_grupo' => 'Grupo Firme',
        //         'telefono' => '3000000005',
        //         'email' => 'grupofirme@musikeventos.com',
        //         'avatar' => 'storage/app/public/grupos/grupo_firme.jpeg',
        //         'descripcion' => 'Agrupacion de musica regional mexicana reconocida por su energia en el escenario.',
        //         'precio_hora' => 2200000,
        //     ],
        //     [
        //         'nit' => 900000006,
        //         'nombre_grupo' => 'Metallica',
        //         'telefono' => '3000000006',
        //         'email' => 'metallica@musikeventos.com',
        //         'avatar' => 'storage/app/public/grupos/metallica.jpeg',
        //         'descripcion' => 'Banda de heavy metal con una trayectoria e influencia mundial.',
        //         'precio_hora' => 3000000,
        //     ],
        // ]);
    }
    public function run2(): void
    {
        $administrador = users::create([
            'email' => 'mican@gmail.com',
            'password' => Hash::make('mican'),
        ]);
        $administrador = users::create([
            'email' => 'jh@gmail.com',
            'password' => Hash::make('jh'),
        ]);
        $administrador = users::create([
            'email' => 'william@gmail.com',
            'password' => Hash::make('william'),
        ]);
        $administrador = users::create([
            'email' => 'sebastian@gmail.com',
            'password' => Hash::make('voceragey'),
        ]);
    }
}
