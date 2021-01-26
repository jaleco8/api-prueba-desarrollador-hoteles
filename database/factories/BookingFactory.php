<?php

use App\Models\Booking;
use App\Models\Client;
use App\Models\Room;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'date_from' => $faker->date(), 
        'date_to' => $faker->date(), 
        'price' => $faker->randomFloat(2, 50, 100), 
        'client_id' => Client::all()->random(), 
        'rooms_id' => Room::all()->random()
    ];
});
