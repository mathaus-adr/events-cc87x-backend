<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignUpTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_signup(): void
    {
        $response = $this->post(
            'api/signup',
            ['name' => 'Mathaus Adorno', 'email' => 'test@testexample.com', 'password' => '123']
        );

        $response->assertStatus(201);
        $this->assertDatabaseHas(User::class, ['email' => 'test@testexample.com']);
    }
}
