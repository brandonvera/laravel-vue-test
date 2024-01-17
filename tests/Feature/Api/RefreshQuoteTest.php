<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;
use Tests\TestCase;

class RefreshQuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_refresh_random_quotes()
    {
        $mockResponse = new Response(
            json_encode(['contents' => ['quotes' => [
                ['quote' => 'Quote 1', 'author' => 'Author 1'],
            ]]]),
            200,
            [],
        );
        $this->mock('GuzzleHttp\Client')->shouldReceive('get')->andReturn($mockResponse);

        $user = User::factory()->create();
        $token = $this->createTokenForUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/refresh-quotes');

        $response->assertStatus(200);
    }

    protected function createTokenForUser($user)
    {
        $secret = config('auth.jwt.secret');
        $token = JWTAuth::fromUser($user, $secret);
        return $token;
    }
}
