<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_successfully()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@api.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(200);

        $response->assertJson([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => [
                'name' => $data['name'],
                'email' => $data['email'],
            ],
            'authorization' => [
                'token' => $response->json('authorization.token'),
                'type' => 'bearer',
            ],
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    public function test_registration_with_invalid_data()
    {
        $data = [
            'name' => '',
            'email' => 'invalid_email',
            'password' => 'short',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors([
            'name',
            'email',
            'password',
        ]);
    }
}
