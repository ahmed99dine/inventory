<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inventory;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
    return [
      // 'order_id' => $faker->numberBetween($min = 1, $max = 10),
        'product_id' => $faker->numberBetween($min = 1, $max = 10),
        'unit_cost' => $faker->numberBetween($min = 1000, $max = 90000),
        'quantity' => $faker->numberBetween($min = 1, $max = 20),
    ];
});
