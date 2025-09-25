<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_user_route_returns_name()
    {
        $response = $this->post('/users/create', [
            'name' => 'John Doe',
            'password' => 'a'
        ]);

        $response->assertStatus(201);
        
        $response->assertJson([
            'message' => 'User created successfully',
            'user' => [
                'name' => 'John Doe',
                'email' => 'default@example.com'
            ]
        ]);

        $response->assertJsonStructure([
            'message',
            'user' => ['name', 'email']
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'default@example.com'
        ]);
    }

    /** @test */
    public function create_user_requires_name_field()
    {
        $response = $this->post('/users/create');

        $response->assertStatus(400);
        
        $response->assertJson([
            'error' => 'name field is required'
        ]);
    }

    /** @test */
    public function create_user_requires_non_empty_name()
    {
        $response = $this->post('/users/create', [
            'name' => ''
        ]);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'name field is required'
        ]);
    }
}