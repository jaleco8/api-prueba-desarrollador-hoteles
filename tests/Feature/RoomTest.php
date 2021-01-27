<?php

namespace Tests\Feature;

use App\Models\Room;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function stores_room()
    {
        $data = [
            'name' => $this->faker->word(), 
            'description' => $this->faker->text(100), 
            'capacity' => $this->faker->randomDigit(), 
            'price' => $this->faker->randomFloat(2, 50, 100)
        ];

        $response = $this->json('POST', $this->baseUrl . "rooms", $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('rooms', $data);

        $room = Room::all()->first();

        $response->assertJson([
            'data' => [
                'id' => $room->id,
                'name' => $room->name,
                'description' => $room->description,
                'capacity' => $room->capacity,
                'price' => $room->price
            ]
        ]);
    }

    /**
     * @test
     */
    public function updates_room()
    {
        $data = [
            'price' => $this->faker->randomFloat(2, 50, 100)
        ];

        $room = create('App\Models\Room');

        $response = $this->json('PUT', $this->baseUrl . "rooms/{$room->id}", $data);
        $response->assertStatus(200);

        $room = $room->fresh();

        $this->assertEquals($room->price, $data['price']);
    }

    /**
     * @test
     */
    public function shows_booking()
    {
        $room = create('App\Models\Room');

        $response = $this->json('GET', $this->baseUrl . "rooms/{$room->id}");
        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $room->id,
                'name' => $room->name,
                'description' => $room->description,
                'capacity' => $room->capacity,
                'price' => $room->price
            ]
        ]);        
    }
}
