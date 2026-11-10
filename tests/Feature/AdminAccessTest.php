<?php

namespace Tests\Feature;

use App\Models\Genero;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_must_sign_in_before_accessing_admin_routes(): void
    {
        $this->get(route('panel.admin'))
            ->assertRedirect(route('login'));

        $this->get(route('generos.create'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_non_admins_cannot_access_or_change_admin_data(): void
    {
        $user = User::factory()->create();
        $genero = Genero::create(['nombre_genero' => 'Cumbia']);

        $this->actingAs($user)
            ->get(route('panel.admin'))
            ->assertForbidden();

        $this->get(route('generos.index'))
            ->assertForbidden();

        $this->post(route('generos.store'), ['nombre_genero' => 'Salsa'])
            ->assertForbidden();

        $this->delete(route('generos.destroy', $genero))
            ->assertForbidden();

        $this->assertDatabaseHas('genero', ['nombre_genero' => 'Cumbia']);
        $this->assertDatabaseMissing('genero', ['nombre_genero' => 'Salsa']);
    }

    public function test_administrators_can_access_the_panel_and_catalog_crud(): void
    {
        $administrator = User::factory()->create(['email' => 'mican@gmail.com']);

        $this->actingAs($administrator)
            ->get(route('panel.admin'))
            ->assertOk();

        $this->get(route('generos.index'))
            ->assertOk();

        $this->post(route('generos.store'), ['nombre_genero' => 'Salsa'])
            ->assertRedirect(route('generos.index'));

        $this->assertDatabaseHas('genero', ['nombre_genero' => 'Salsa']);
    }
}
