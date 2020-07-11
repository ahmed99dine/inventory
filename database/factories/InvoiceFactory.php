<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'inv_number' => $faker->numberBetween($min=1000,$max =9999),
        'inv_date' => $faker->date($format = 'Y-m-d',$max='now'),
        'supplier_id' =>$faker->numberBetween($min = 1,$max=9),
        'order_id'=> $faker->numberBetween($min= 1, $max=9)
    ];
});
