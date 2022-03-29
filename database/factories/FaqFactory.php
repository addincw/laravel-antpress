<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Faq::class, function (Faker $faker) {
    return [
      'question' => $faker->sentence($nbWords = 6, $variableNbWords = true),
      'answer' => $faker->sentence($nbWords = 24, $variableNbWords = true),
    ];
});
