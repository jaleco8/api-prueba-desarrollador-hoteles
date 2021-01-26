<?php

use App\Models\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name' => $faker->word(), 
        'description' => $faker->text(100), 
        'capacity' => $faker->randomDigit(), 
        'price' => $faker->randomFloat(2, 50, 100)
    ];
});
