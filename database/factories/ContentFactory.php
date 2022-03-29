<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Contents\Content::class, function (Faker $faker) {
    $file = $faker->image('storage/app/public/content', 640, 480, null, true);
    $file = str_replace('storage/app/public/content\\', '/content/', $file);
    $fileCreator = $faker->image('storage/app/public/content', 480, 480, null, true);
    $fileCreator = str_replace('storage/app/public/content\\', '/content/', $fileCreator);

    $category = App\Models\Contents\ContentCategory::inRandomOrder()
                ->limit(5)
                ->where('is_delete', false)
                ->first();

    $title = $faker->title;
    return [
      'title' => $title,
      'thumbnail' => $file,
      'description' => $faker->paragraph($nbSentences = 15, $variableNbSentences = true),
      'slug' => str_replace(' ', '-', $title) . '-' . rand(10,100),
      'content_category_id' => $category->id,
      'type' => 'blog',
      'creator_name' => $faker->name,
      'creator_title' => $faker->jobTitle,
      'creator_image' => $fileCreator,
    ];
});
