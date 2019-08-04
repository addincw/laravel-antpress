<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

use \App\Models\Profile;
use \App\Models\Contents\ContentFile;
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

      ContentFile::truncate();
      Content::truncate();
      ContentCategory::truncate();

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
          'title' => 'departemen',
          'slug' => 'departemen',
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
          'title' => 'umum',
          'slug' => 'umum',
          'created_at' => date('Y-m-d H:i:s'),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false,
          'type' => 'media'
        ],
        [
          'title' => 'sejarah',
          'slug' => 'sejarah',
          'created_at' => date('Y-m-d H:i:s'),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false,
          'type' => null
        ],
        [
          'title' => 'visi misi',
          'slug' => 'visi-misi',
          'created_at' => date('Y-m-d H:i:s'),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false,
          'type' => null
        ],
        [
          'title' => 'fasilitas',
          'slug' => 'fasilitas',
          'created_at' => date('Y-m-d H:i:s'),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false,
          'type' => null
        ],
        [
          'title' => 'indikator mutu',
          'slug' => 'indikator-mutu',
          'created_at' => date('Y-m-d H:i:s'),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false,
          'type' => null
        ],
        [
          'title' => 'kontak kami',
          'slug' => 'kontak-kami',
          'created_at' => date('Y-m-d H:i:s'),
          'content_category_id' => $categoryUmum->id,
          'is_delete' => false,
          'type' => null
        ],
      ]);

      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
