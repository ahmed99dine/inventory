<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'supplier_id' => $faker->numberBetween($min = 1, $max=9),
        'order_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        
    ];
});
