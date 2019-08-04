<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Doctor::class, function (Faker $faker) {
    $file = $faker->image('public/storage/doctor', 480, 480, null, true);
    $file = str_replace('public/storage/doctor\\', '/doctor/', $file);
    return [
      'name' => $faker->name,
      'specialist' => $faker->catchPhrase,
      'gender' => array_rand([1, 0], 1),
      'image' => $file,
    ];
});
