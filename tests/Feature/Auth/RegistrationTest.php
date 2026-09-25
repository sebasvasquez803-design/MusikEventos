<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get(route('register'));

        $response->assertOk();
    }

    public function test_new_users_can_register(): void
    {
        // Comprueba creación, autenticación, redirección y contraseña cifrada.
        $response = $this->post(route('register.store'), [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $user = User::where('email', 'test@example.com')->first();

        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('home', absolute: false));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
        ]);
        $this->assertTrue(Hash::check('password', $user->password));
    }

    public function test_authenticated_user_can_create_legal_representative_from_user_and_curriculum(): void
    {
        $user = User::create([
            'name' => 'Ana Torres',
            'email' => 'ana@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->actingAs($user);

        $response = $this->post(route('curriculum.rep.store'), [
            'numero_doc' => '1234567890',
            'apellido' => 'Torres',
            'anio_inicio' => 2019,
            'anio_fin' => 2024,
            'eventos_realizados' => 12,
            'titulo_obtenido' => 'Especialista en gestión cultural',
            'habilidades_principales' => 'Liderazgo y coordinación',
            'academia_formacion' => 'Academia de Música',
            'estudios' => 'Universitario',
            'publico_privado' => 'ambos',
        ]);

        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('dash.rep', absolute: false));

        $this->assertDatabaseHas('usuario', [
            'nombre' => 'Ana Torres',
            'apellido' => 'Torres',
            'numero_doc' => '1234567890',
            'id_tipo_persona' => 1,
        ]);

        $this->assertDatabaseHas('curriculum', [
            'numero_doc' => '1234567890',
            'titulo_obtenido' => 'Especialista en gestión cultural',
            'habilidades_principales' => 'Liderazgo y coordinación',
        ]);
    }
}
