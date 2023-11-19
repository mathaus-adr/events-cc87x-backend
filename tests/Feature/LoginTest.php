<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_login(): void
    {
        $user = User::factory()->create();

        $response = $this->post(
            'api/login',
            ['email' => $user->email, 'password' => 'password']
        );

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }
}
