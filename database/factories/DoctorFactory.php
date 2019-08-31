<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Doctor::class, function (Faker $faker) {
    $file = $faker->image('storage/app/public/doctor', 480, 480, null, true);
    $file = str_replace('storage/app/public/doctor\\', '/doctor/', $file);
    return [
      'name' => $faker->name,
      'specialist' => $faker->catchPhrase,
      'gender' => array_rand([1, 0], 1),
      'image' => $file,
    ];
});
