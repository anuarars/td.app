<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $data = [  
        'user_id' => rand(1, 2),  
        'name' => $faker->word(),
        'category_id' => rand(4, 10),
        'review_start' => $faker->dateTimeBetween('-9 day', '1 day'),
        'review_end' => $faker->dateTimeBetween('-2 days', '2 month'),
        'order_discuss' => $faker->dateTimeBetween('-2 days', '2 month'),
        'status' => rand(0, 1),
    ];

    return $data;
});
