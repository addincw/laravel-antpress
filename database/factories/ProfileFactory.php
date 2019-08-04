<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    $name = $faker->company;
    return [
      'title' => $name,
      'description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
      'phone' => $faker->phoneNumber,
      'address' => "$faker->streetAddress. $faker->city, $faker->state. $faker->postcode.",
      'email' => $faker->email,
      'facebook' => $name . '@facebook',
      'twitter' => $name . '@twitter',
      'instagram' => $name . '@instagram',
      'youtube' => $name . '@youtube',
    ];
});
