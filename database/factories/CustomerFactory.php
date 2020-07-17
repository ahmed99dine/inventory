<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Customer::class, function (Faker $faker) {
    return [
      'f_name' => $faker->firstNameMale,
      'l_name' => $faker->lastName,
      'phone' => $faker->e164PhoneNumber,
      'email' => $faker->unique()->safeEmail,
      // 'location' => $faker->streetName,
      'outstanding_debt' =>$faker->numberBetween($min=10000, $max=999999)
    ];
});
