<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneroSubgeneroSeeder extends Seeder
{
    public function run(): void
    {
        $generos = [
            'Pop' => ['Pop latino', 'Pop rock', 'Synth pop', 'Indie pop', 'K-pop'],
            'Rock' => ['Rock alternativo', 'Rock clásico', 'Hard rock', 'Heavy metal', 'Punk rock', 'Grunge', 'Progressive rock'],
            'Salsa' => ['Salsa clásica', 'Salsa urbana', 'Salsa romántica', 'Salsa choke'],
            'Reguetón' => ['Reguetón clásico', 'Reguetón urbano', 'Reguetón romántico', 'Perreo'],
            'Música urbana' => ['Rap', 'Hip hop', 'Trap', 'Drill', 'R&B', 'Freestyle'],
            'Música regional' => ['Banda', 'Norteño', 'Ranchera', 'Corrido', 'Mariachi', 'Regional mexicano'],
            'Vallenato' => ['Vallenato tradicional', 'Vallenato moderno', 'Vallenato romántico', 'Puya', 'Paseo vallenato'],
            'Electrónica' => ['House', 'Techno', 'Trance', 'Dubstep', 'Drum and bass', 'Deep house', 'Electro pop'],
            'Merengue' => ['Merengue tradicional', 'Merengue urbano', 'Merengue típico'],
            'Bachata' => ['Bachata tradicional', 'Bachata moderna', 'Bachata urbana'],
            'Cumbia' => ['Cumbia tradicional', 'Cumbia villera', 'Cumbia sabanera', 'Cumbia urbana'],
            'Tropical' => ['Porro', 'Champeta', 'Bolero', 'Mambo', 'Son cubano'],
            'Folclor' => ['Joropo', 'Pasillo', 'Bambuco', 'Currulao', 'Guabina', 'Cantos de vaquería'],
            'Jazz' => ['Jazz clásico', 'Smooth jazz', 'Jazz fusión', 'Latin jazz', 'Bebop'],
            'Blues' => ['Blues clásico', 'Blues rock', 'Delta blues', 'Soul blues'],
            'Country' => ['Country clásico', 'Country pop', 'Bluegrass', 'Americana'],
            'Reggae' => ['Reggae roots', 'Dancehall', 'Ska', 'Dub'],
            'Clásica' => ['Barroca', 'Clásica', 'Romántica', 'Ópera', 'Música de cámara'],
            'Góspel' => ['Góspel tradicional', 'Góspel contemporáneo', 'Música cristiana'],
        ];

        foreach ($generos as $nombreGenero => $subgeneros) {
            DB::table('genero')->updateOrInsert(
                ['nombre_genero' => $nombreGenero],
                ['nombre_genero' => $nombreGenero]
            );

            $generoId = DB::table('genero')
                ->where('nombre_genero', $nombreGenero)
                ->value('id_genero');

            foreach ($subgeneros as $nombreSubgenero) {
                DB::table('subgenero')->updateOrInsert(
                    [
                        'nombre_subgenero' => $nombreSubgenero,
                        'id_genero' => $generoId,
                    ],
                    [
                        'nombre_subgenero' => $nombreSubgenero,
                        'id_genero' => $generoId,
                    ]
                );
            }
        }
    }
}
