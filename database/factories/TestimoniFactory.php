<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Testimoni::class, function (Faker $faker) {
    $file = $faker->image('public/storage/testimoni', 480, 480, null, true);
    $file = str_replace('public/storage/testimoni\\', '/testimoni/', $file);

    return [
      'name' => $faker->name,
      'from' => $faker->company,
      'body' => $faker->sentence($nbWords = 6, $variableNbWords = true),
      'thumbnail' => $file,
    ];
});
