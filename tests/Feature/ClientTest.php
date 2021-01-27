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
            'identityCard' => $this->faker->randomNumber(7, true), 
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
}
