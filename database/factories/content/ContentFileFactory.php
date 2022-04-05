<?php

use Faker\Generator as Faker;

use App\Models\Contents\Content;

$factory->define(App\Models\Contents\ContentFile::class, function (Faker $faker) {
    $file = $faker->image('storage/app/public/gallery', 640, 480, null, true);
    $file = str_replace('storage/app/public/gallery\\', '/gallery/', $file);

    $content = Content::inRandomOrder()->limit(5)->where('type', 'blog')->first();

    return [
      'title' => $faker->title,
      'description' => $faker->text,
      'file' => $file,
      'file_type' => 'image',
      'is_highlight' => array_rand([1, 0], 1),
      'content_id' => $content->id
    ];
});
