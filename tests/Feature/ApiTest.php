<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    /**
     * Basic test to store a user
     */
    public function testStoreUser()
    {
        $response = $this->json('POST', '/api/users', ['name' => 'Sally', 'id' => rand(0, 1000), 'email' => 'sally@gmail.com', 'image' => 'hola.jpg']);

        $response
                ->assertStatus(200)
                ->assertJson([
                    'response' => 'The user was successfully created.'
        ]);
    }
}
