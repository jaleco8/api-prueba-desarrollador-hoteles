<?php

use App\Models\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName(),
        'lastname' => $faker->lastName(), 
        'identityCard' => $faker->randomNumber(7, true), 
        'address' => $faker->streetAddress(), 
        'phone' => $faker->phoneNumber()
    ];
});
