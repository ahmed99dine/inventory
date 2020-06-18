<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'model_no' => $faker->unique()->buildingNumber,
        'make'=> $faker->unique()->company,
        'description'=> $faker->colorName,
        'year'=> $faker->year($max = 'now'),
    ];
});
