<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class BlockUserTest extends TestCase
{
    public function test_admin_can_block_user()
    {
        $admin = User::factory()->create(['role' => 1]);

        $userToBlock = User::factory()->create();

        $this->actingAs($admin);
        $token = $this->createTokenForUser($admin);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                      ->postJson('/api/block-user', [
                          'user_id' => $userToBlock->id,
                          'status' => 0,
                      ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'User status changed!']);

        $this->assertDatabaseHas('users', [
            'id' => $userToBlock->id,
            'status' => 0,
        ]);
    }

    public function test_non_admin_cannot_block_user()
    {
        $user = User::factory()->create(['role' => 0]);

        $this->actingAs($user);
        $token = $this->createTokenForUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                      ->postJson('/api/block-user', [
                          'user_id' => User::factory()->create()->id,
                          'status' => 0,
                      ]);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Unauthorized']);
    }

    protected function createTokenForUser($user)
    {
        $secret = config('auth.jwt.secret');
        $token = JWTAuth::fromUser($user, $secret);
        return $token;
    }
}
