<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Contents\Content::class, function (Faker $faker) {
    $category = App\Models\Contents\ContentCategory::inRandomOrder()->limit(10)->first();
    $title = $faker->title;
    return [
      'title' => $title,
      'description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
      'slug' => str_replace(' ', '-', $title) . '-' . rand(10,100),
      'content_category_id' => $category->id
    ];
});
