<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_user(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->postJson('/users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.email', 'test@example.com')
            ->assertJsonMissingPath('data.password');

        $this->assertTrue(Hash::check('password123', User::where('email', 'test@example.com')->firstOrFail()->password));
    }

    public function test_authenticated_user_can_update_email_and_reset_verification(): void
    {
        $this->actingAs(User::factory()->create());
        $user = User::factory()->create();

        $response = $this->patchJson("/users/{$user->id}", [
            'email' => 'updated@example.com',
        ]);

        $response->assertOk()
            ->assertJsonPath('data.email', 'updated@example.com');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'updated@example.com',
            'email_verified_at' => null,
        ]);
    }
}
