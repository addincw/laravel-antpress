<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Site\Configuration::class, function (Faker $faker) {
    $title = 'Laravel Content Manager';
    $name = 'lcm';

    return [
      'title' => $title,
      'description' => $faker->text($maxNbChars = 200),
      'phone' => $faker->phoneNumber,
      'whatsapp' => $faker->phoneNumber,
      'telegram' => $faker->phoneNumber,
      'address' => $faker->address,
      'email' => $name . '@gmail.com',
      'facebook' => $name . '@facebook',
      'twitter' => $name . '@twitter',
      'instagram' => $name . '@instagram',
      'youtube' => $name . '@youtube',
    ];
});
