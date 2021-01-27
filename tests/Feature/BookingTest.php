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
                'price' => $booking->price,
                'client_id' => $booking->client_id,
                'rooms_id' => $booking->rooms_id
            ]
        ]);
    }

    /**
     * @test
     */
    public function updates_booking()
    {
        $data = [
            'date_from' => $this->faker->date(),
            'date_to' => $this->faker->date()
        ];

        create('App\Models\Client');
        create('App\Models\Room');
        $booking = create('App\Models\Booking');

        $response = $this->json('PUT', $this->baseUrl . "bookings/{$booking->id}", $data);
        $response->assertStatus(200);

        $booking = $booking->fresh();

        $this->assertEquals($booking->date_from, $data['date_from']);
        $this->assertEquals($booking->date_to, $data['date_to']);

    }

    /**
     * @test
     */
    public function shows_booking()
    {
        create('App\Models\Client');
        create('App\Models\Room');
        $booking = create('App\Models\Booking');

        $response = $this->json('GET', $this->baseUrl . "bookings/{$booking->id}");
        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $booking->id,
                'date_from' => $booking->date_from,
                'date_to' => $booking->date_to,
                'price' => $booking->price,
                'client_id' => $booking->client_id,
                'rooms_id' => $booking->rooms_id
            ]
        ]);
    }
}
