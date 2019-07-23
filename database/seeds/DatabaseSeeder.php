<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

use \App\Models\Profile;
use \App\Models\Contents\ContentCategory;
use \App\Models\Contents\Content;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $faker = FakerFactory::create();
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      Profile::truncate();
      ContentCategory::truncate();
      Content::truncate();

      factory(Profile::class)->create();
      ContentCategory::insert([
        [
          'title' => 'pelayanan & penunjang',
          'slug' => 'pelayanan-&-penunjang',
          'is_delete' => false
        ],
        [
          'title' => 'informasi umum',
          'slug' => 'informasi-umum',
          'is_delete' => false
        ],
        [
          'title' => 'tim kami',
          'slug' => 'tim-kami',
          'is_delete' => false
        ],
        [
          'title' => 'klinik',
          'slug' => 'klinik',
          'is_delete' => false
        ],
        [
          'title' => 'kamar',
          'slug' => 'kamar',
          'is_delete' => false
        ]
      ]);

      $categoryUmum = ContentCategory::where('slug', 'informasi-umum')->first();
      Content::insert([
        [
          'title' => 'sejarah',
          'slug' => 'sejarah',
          'description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false
        ],
        [
          'title' => 'visi misi',
          'slug' => 'visi-misi',
          'description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false
        ],
        [
          'title' => 'fasilitas',
          'slug' => 'fasilitas',
          'description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false
        ],
        [
          'title' => 'indikator mutu',
          'slug' => 'indikator-mutu',
          'description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false
        ],
        [
          'title' => 'kontak kami',
          'slug' => 'kontak-kami',
          'description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false
        ],
      ]);

      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
