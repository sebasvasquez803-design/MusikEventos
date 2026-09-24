<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.(Su función es orquestar el orden de ejecución de otros seeders
     * específicos mediante el método call(), lo que hace que laravel inserte los datos de prueba segun
     * como dejo su orden estricto)
     */
    public function run(): void
    {
        $this->call([
            TipoPersonaSeeder::class,
            GeneroSubgeneroSeeder::class,
            GrupoMusicalSeeder::class,
            ClienteSeeder::class,
            RepresentanteLegalSeeder::class,
            ArtistaSolistaSeeder::class,
            AdministradorSeeder::class,
        ]);
    }
}
