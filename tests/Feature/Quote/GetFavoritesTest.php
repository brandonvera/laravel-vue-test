<?php

namespace Tests\Feature\Quote;

use App\Models\User;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class GetFavoritesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_favorite_quotes()
    {
        $user = User::factory()->create();
        Quote::factory()->count(3)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $token = $this->createTokenForUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson('/api/favorites-quotes/' . $user->id);

        $response->assertStatus(200);
    }

    protected function createTokenForUser($user)
    {
        $secret = config('auth.jwt.secret');
        $token = JWTAuth::fromUser($user, $secret);
        return $token;
    }
}
