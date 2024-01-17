<?php

namespace Tests\Feature\Quote;

use App\Models\User;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class SaveFavoritesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_save_a_favorite_quote()
    {
        $user = User::factory()->create();
        $token = $this->createTokenForUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/save-quote', [
                'quote' => 'A test quote',
                'author' => 'Test Author',
                'user_id' => $user->id,
            ]);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'Quote saved!']);

        $this->assertDatabaseHas('quotes', [
            'quote' => 'A test quote',
            'author' => 'Test Author',
            'user_id' => $user->id,
        ]);
    }

    protected function createTokenForUser($user)
    {
        $secret = config('auth.jwt.secret');
        $token = JWTAuth::fromUser($user, $secret);
        return $token;
    }
}
