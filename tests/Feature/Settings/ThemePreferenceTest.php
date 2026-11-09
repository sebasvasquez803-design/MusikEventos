<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThemePreferenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_save_their_theme_preference(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->patchJson(route('preferences.theme.update'), ['theme' => 'dark']);

        $response->assertOk()
            ->assertJson(['theme' => 'dark']);

        $this->assertSame('dark', $user->fresh()->theme);
    }

    public function test_guests_cannot_save_a_theme_preference(): void
    {
        $this->patchJson(route('preferences.theme.update'), ['theme' => 'dark'])
            ->assertUnauthorized();
    }

    public function test_only_supported_themes_can_be_saved(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->patchJson(route('preferences.theme.update'), ['theme' => 'blue'])
            ->assertUnprocessable();

        $this->assertSame('light', $user->fresh()->theme);
    }
}
