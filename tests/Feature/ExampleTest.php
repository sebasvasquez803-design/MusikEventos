<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_successful_response(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
    }

    public function test_homepage_lists_genres_from_the_database_as_filters(): void
    {
        DB::table('genero')->insert([
            ['nombre_genero' => 'Jazz'],
            ['nombre_genero' => 'Música urbana'],
        ]);

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('data-genre="Jazz"', false)
            ->assertSee('data-genre="Música urbana"', false);
    }

    public function test_homepage_defers_review_query_until_review_endpoint_is_requested(): void
    {
        $genreId = DB::table('genero')->insertGetId(['nombre_genero' => 'Cumbia']);
        $subgenreId = DB::table('subgenero')->insertGetId([
            'nombre_subgenero' => 'Salsa',
            'id_genero' => $genreId,
            'nit' => '1234567890',
        ]);

        DB::table('grupo_musical')->insert([
            'nit' => '1234567890',
            'id_subgenero' => $subgenreId,
            'nombre_grupo' => 'Grupo de prueba',
        ]);

        DB::table('resenas')->insert([
            'nit' => '1234567890',
            'nombre_usuario' => 'Usuario de prueba',
            'comentario' => 'Buena presentación',
            'numero_estrellas' => 5,
        ]);

        $reviewQueries = 0;

        DB::listen(function (QueryExecuted $query) use (&$reviewQueries): void {
            if (preg_match('/\bfrom\s+[`"]?resenas[`"]?/i', $query->sql) === 1) {
                $reviewQueries++;
            }
        });

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('Grupo de prueba')
            ->assertSee('data-genero="Salsa,Cumbia"', false)
            ->assertSee('data-reviews-url=', false)
            ->assertDontSee('data-reviews=', false);
        $this->assertSame(0, $reviewQueries);

        $this->getJson(route('grupo-musical.reviews', ['nit' => '1234567890']))
            ->assertOk()
            ->assertJsonPath('reviews.0.nombre', 'Usuario de prueba')
            ->assertJsonPath('reviews.0.texto', 'Buena presentación');
        $this->assertSame(1, $reviewQueries);
    }
}
