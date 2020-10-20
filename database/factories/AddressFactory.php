<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    $data = [
        'user_id' => rand(1,4),  
        'region_id' => rand(1, 10),
        'district' => 'Акмолинская Область',
        'town' => $faker->word(),
        'home' => $faker->buildingNumber(),  
        'street' => $faker->streetName(),
        'unit' => rand(1, 99),  
        'postcode' => rand(100000, 999999),
    ];

    return $data;
});
