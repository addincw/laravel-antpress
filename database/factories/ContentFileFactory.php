<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Contents\ContentFile::class, function (Faker $faker) {
    return [
      'title' => $faker->title,
      'description' => $faker->text,
      'file' => $faker->image($dir, $width, $height, $faker->word),
      'file_type' => 'image',
      'is_hightlight' => false
    ];
});
