<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Site\Configuration::class, function (Faker $faker) {
    $title = 'Antpress';
    $name = 'antpress';

    return [
      'title' => $title,
      'description' => 'Alternative content management system (CMS) of wordpress, build with laravel. Developer oriented, give initial setup and common features of CMS. Easy to maintain, overrides, and custom with all of utilities provided by laravel.',
      'phone' => $faker->phoneNumber,
      'whatsapp' => $faker->phoneNumber,
      'telegram' => $faker->phoneNumber,
      'address' => $faker->address,
      'email' => $name . '@gmail.com',
      'facebook' => $name . '_facebook',
      'twitter' => $name . '_twitter',
      'instagram' => $name . '_instagram',
      'youtube' => $name . '_youtube',
    ];
});
