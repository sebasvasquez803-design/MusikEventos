<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoMusicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subgenerosPorGrupo = [
            'Arcangel' => 'Reguetón clásico',
            'LA 33' => 'Salsa clásica',
            'Sebastian Yatra' => 'Pop latino',
            'Manas Rufino' => 'Rap',
            'Grupo Firme' => 'Banda',
            'Metallica' => 'Heavy metal',
        ];

        $grupos = [];

        foreach ($subgenerosPorGrupo as $nombreGrupo => $subgeneroNombre) {
            $idSubgenero = DB::table('subgenero')
                ->where('nombre_subgenero', $subgeneroNombre)
                ->value('id_subgenero');

            $datosGrupo = match ($nombreGrupo) {
                'Arcangel' => [
                    'nit' => 900000001,
                    'nombre_grupo' => 'Arcangel',
                    'telefono' => '3000000001',
                    'email' => 'arcangel@musikeventos.com',
                    'avatar' => 'grupos/arcangel.jpg',
                    'logo' => 'grupos/arcangel.jpg',
                    'video_url' => 'https://www.youtube.com/watch?v=Vv8t0j2mEwU',
                    'descripcion' => 'Una leyenda viva del genero urbano. Su flow inconfundible asegura un show de clase mundial.',
                    'precio_hora' => 1500000,
                ],
                'LA 33' => [
                    'nit' => 900000002,
                    'nombre_grupo' => 'LA 33',
                    'telefono' => '3000000002',
                    'email' => 'la33@musikeventos.com',
                    'avatar' => 'grupos/la33.jpg',
                    'logo' => 'grupos/la33.jpg',
                    'video_url' => 'https://www.youtube.com/watch?v=2jKDaM5P5zM',
                    'descripcion' => 'Orquesta colombiana de salsa urbana con un repertorio lleno de energia.',
                    'precio_hora' => 1800000,
                ],
                'Sebastian Yatra' => [
                    'nit' => 900000003,
                    'nombre_grupo' => 'Sebastian Yatra',
                    'telefono' => '3000000003',
                    'email' => 'yatra@musikeventos.com',
                    'avatar' => 'grupos/yatra.jpg',
                    'logo' => 'grupos/yatra.jpg',
                    'video_url' => 'https://www.youtube.com/watch?v=ZJj1OzBzI60',
                    'descripcion' => 'Cantante colombiano de pop y regueton con letras romanticas.',
                    'precio_hora' => 2500000,
                ],
                'Manas Rufino' => [
                    'nit' => 900000004,
                    'nombre_grupo' => 'Manas Rufino',
                    'telefono' => '3000000004',
                    'email' => 'manas@musikeventos.com',
                    'avatar' => 'grupos/manas.jpg',
                    'logo' => 'grupos/manas.jpg',
                    'video_url' => 'https://www.youtube.com/watch?v=QK0mZ2GJ5nI',
                    'descripcion' => 'Rapero y compositor colombiano, cofundador de Doble Porcion.',
                    'precio_hora' => 1200000,
                ],
                'Grupo Firme' => [
                    'nit' => 900000005,
                    'nombre_grupo' => 'Grupo Firme',
                    'telefono' => '3000000005',
                    'email' => 'grupofirme@musikeventos.com',
                    'avatar' => 'grupos/grupo_firme.jpg',
                    'logo' => 'grupos/grupo_firme.jpg',
                    'video_url' => 'https://youtu.be/nOxOkQs21p8?si=4LQGPOxCN0hNYpN0',
                    'descripcion' => 'Agrupacion de musica regional mexicana reconocida por su energia en el escenario.',
                    'precio_hora' => 2200000,
                ],
                'Metallica' => [
                    'nit' => 900000006,
                    'nombre_grupo' => 'Metallica',
                    'telefono' => '3000000006',
                    'email' => 'metallica@musikeventos.com',
                    'avatar' => 'grupos/metallica.jpg',
                    'logo' => 'grupos/metallica.jpg',
                    'video_url' => 'https://www.youtube.com/watch?v=QfPxA4e7z48',
                    'descripcion' => 'Banda de heavy metal con una trayectoria e influencia mundial.',
                    'precio_hora' => 3000000,
                ],
                default => []
            };

            if (!empty($datosGrupo)) {
                $datosGrupo['id_subgenero'] = $idSubgenero;
                $grupos[] = $datosGrupo;
            }
        }

        DB::table('grupo_musical')->upsert($grupos, ['nit'], [
            'id_subgenero',
            'nombre_grupo',
            'telefono',
            'email',
            'avatar',
            'logo',
            'video_url',
            'descripcion',
            'precio_hora',
        ]);
    }
}
