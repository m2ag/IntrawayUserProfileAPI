<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    /**
     * Test get all stored users, checks http status code of the response, 
     * the expected 200. Second assert, checks that the response is a JSON message.
     */
    public function testGetAllUsers()
    {
        $response = $this->json('GET', '/api/users');

        $response
                ->assertStatus(200)
                ->assertJson([]);
    }
    
    /**
     * Test get a user by Id, checks http status code of the response, 
     * the expected 200. Second assert, checks that the JSON message contains the key "id".
     */
    public function testGetUserById()
    {
        $response = $this->json('GET', '/api/users/3');

        $response
                ->assertStatus(200)
                ->assertJsonFragment([
                    'id' => 3,
                ]);
    }
    
    /**
     * Test get a user by a wrong Id, checks http status code of the response, 
     * the expected "Bad request" 400. Second assert, checks that the JSON 
     * message contains the key "id".
     */
    public function testGetUserByWrongId()
    {
        $response = $this->json('GET', '/api/users/34');

        $response
                ->assertStatus(400)
                ->assertJsonStructure([
                    'response',
                ]);
    }
    
    /**
     * Test create a user, checks http status code of the response, 
     * the expected 200 and the second assert, checks structure of 
     * the JSON message
     */
    public function testCreateUser()
    {
        $id = rand(0, 1000);
        $response = $this->json('POST', '/api/users', ['name' => "Sally{$id}", 'id' => $id, 'email' => "sally{$id}@gmail.com", 'image' => 'image.jpg']);

        $response
                ->assertStatus(200)
                ->assertJson([
                    'response' => 'The user was successfully created.'
        ]);
    }
    
    /**
     * Checks thats http status code of the response is 400 "Bad request", 
     * when missing mandatory data (id, name, email, image), 
     * the second assert, checks that the JSON message contains the key "errors".
     */
    public function testCreateUserIncompleteData()
    {
        $id = rand(0, 1000);
        $response = $this->json('POST', '/api/users', ['name' => "Sally{$id}", 'id' => $id]);

        $response
                ->assertStatus(400)
                ->assertJsonStructure([
                    'response',
                    'errors',
                ]);
       
    }
    
    /**
     * Checks thats http status code of the response is 400 "Bad request", 
     * when the data is invalid such as email not valid or id isn't integer, 
     * the second assert, checks that the JSON message contains the key "errors".
     */
    public function testCreateUserInvalidData()
    {
        $id = rand(0, 1000);
        $response = $this->json('POST', '/api/users', ['name' => "Sally{$id}", 'id' => "d{$id}", 'email' => "sally{$id}gmail.com", 'image' => 'image.jpg']);

        $response
                ->assertStatus(400)
                ->assertJsonStructure([
                    'response',
                    'errors',
                ]);
       
    }
    

}
