<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Clinics\Clinic::class, function (Faker $faker) {
    $file = $faker->image('public/storage/clinic', 640, 480, null, true);
    $file = str_replace('public/storage/clinic\\', '/clinic/', $file);

    $name = $faker->company;
    return [
      'title' => $name,
      'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
      'thumbnail' => $file,
      'slug' => str_replace(" ", "-", $name),
    ];
});
