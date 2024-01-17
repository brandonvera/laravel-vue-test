<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_profile()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $token = $this->createTokenForUser($user);

        $data = [
            'name' => 'Updated Name',
            'user_id' => $user->id,
        ];
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/update-profile', $data);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'update completed']);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
        ]);
    }

    protected function createTokenForUser($user)
    {
        $secret = config('auth.jwt.secret');
        $token = JWTAuth::fromUser($user, $secret);
        return $token;
    }
}
