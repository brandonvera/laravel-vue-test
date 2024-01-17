<?php

namespace Tests\Feature\Quote;

use App\Models\User;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class DeleteFavoritesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_delete_favorite_quote()
    {
        $user = User::factory()->create();
        $quote = Quote::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $token = $this->createTokenForUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/delete-quote/' . $quote->id);

        $response->assertStatus(200);

        $this->assertNull(Quote::find($quote->id));
    }
    
    protected function createTokenForUser($user)
    {
        $secret = config('auth.jwt.secret');
        $token = JWTAuth::fromUser($user, $secret);
        return $token;
    }

}
