<?php

namespace Tests\Feature;

use App\Models\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function stores_client()
    {
        $data = [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(), 
            'identityCard' => $this->faker->bothify('?-#######'), 
            'address' => $this->faker->streetAddress(), 
            'phone' => $this->faker->phoneNumber()
        ];

        $response = $this->json('POST', $this->baseUrl . "clients", $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('clients', $data);

        $client = Client::all()->first();

        $response->assertJson([
            'data' => [
                'id' => $client->id,
                'name' => $client->name,
                'lastname' => $client->lastname,
                'identityCard' => $client->identityCard,
                'address' => $client->address,
                'phone' => $client->phone
            ]
        ]);
    }

    /**
     * @test
     */
    public function updates_client()
    {
        $data = [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber()
        ];

        $client = create('App\Models\Client');

        $response = $this->json('PUT', $this->baseUrl . "clients/{$client->id}", $data);
        $response->assertStatus(200);

        $client = $client->fresh();

        $this->assertEquals($client->name, $data['name']);
        $this->assertEquals($client->lastname, $data['lastname']);
        $this->assertEquals($client->phone, $data['phone']);
    }

    /**
     * @test
     */
    public function shows_booking()
    {
        $client = create('App\Models\Client');

        $response = $this->json('GET', $this->baseUrl . "clients/{$client->id}");
        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $client->id,
                'name' => $client->name,
                'lastname' => $client->lastname,
                'identityCard' => $client->identityCard,
                'address' => $client->address,
                'phone' => $client->phone
            ]
        ]);
    }
}
