<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    return [
      'title' => $faker->company,
      'description' => $faker->streetAddress,
      'phone' => $faker->phoneNumber,
      'address' => "$faker->streetAddress. $faker->city, $faker->state. $faker->postcode.",
      'email' => $faker->email,
      'facebook' => $faker->email,
      'twitter' => $faker->email,
      'instagram' => $faker->email,
      'youtube' => $faker->email,
    ];
});
