<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RefreshTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_refresh_token_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $token = $this->createTokenForUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/refresh');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'user',
            'authorisation' => ['token', 'type']
        ]);
    }

    protected function createTokenForUser($user)
    {
        $secret = config('auth.jwt.secret');
        $token = JWTAuth::fromUser($user, $secret);
        return $token;
    }
}
