<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    $name = 'inidokterku';
    return [
      'title' => $name,
      'description' => '',
      'phone' => '',
      'whatsapp' => '',
      'telegram' => '',
      'address' => '',
      'email' => $name . '@gmail.com',
      'facebook' => $name . '@facebook',
      'twitter' => $name . '@twitter',
      'instagram' => $name . '@instagram',
      'youtube' => $name . '@youtube',
    ];
});
