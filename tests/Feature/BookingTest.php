<?php

namespace Tests\Feature;

use App\Models\Booking;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function stores_booking()
    {
        $client = create('App\Models\Client');
        $room = create('App\Models\Room');

        $data = [
            'date_from' => $this->faker->date(),
            'date_to' => $this->faker->date(),
            'price' => $this->faker->randomFloat(2, 50, 100),
            'client_id' => $client->id,
            'rooms_id' => $room->id
        ];

        $response = $this->json('POST', $this->baseUrl . "bookings", $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('bookings', $data);

        $booking = Booking::all()->first();

        $response->assertJson([
            'data' => [
                'id' => $booking->id,
                'date_from' => $booking->date_from,
                'date_to' => $booking->date_to,
                'price' => $booking->identitypriceCard,
                'client_id' => $booking->client_id,
                'rooms_id' => $booking->rooms_id
            ]
        ]);
    }
}
