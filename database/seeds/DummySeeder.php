<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

use \App\Models\Testimoni;
use \App\Models\Contents\Content;
use App\Models\Contents\ContentCategory;
use \App\Models\Contents\ContentFile;
use App\Models\Faq;

class DummySeeder extends Seeder
{
    // private $primaryContents = ['umum', 'sejarah', 'visi-misi', 'fasilitas', 'indikator-mutu', 'kontak-kami'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');

      ContentCategory::truncate();
      ContentFile::truncate();
      Content::truncate();
      Faq::truncate();
      Testimoni::truncate();

      \Storage::deleteDirectory('/content');
      \Storage::deleteDirectory('/testimoni');
      \Storage::deleteDirectory('/gallery');

      if (!is_dir('storage/app/public/content')) {
        \File::makeDirectory('storage/app/public/content', $mode = 0755, true, true);
      }
      if (!is_dir('storage/app/public/testimoni')) {
        \File::makeDirectory('storage/app/public/testimoni', $mode = 0755, true, true);
      }
      if (!is_dir('storage/app/public/gallery')) {
        \File::makeDirectory('storage/app/public/gallery', $mode = 0755, true, true);
      }

      ContentCategory::insert([
        [
          'title' => 'music',
          'slug' => 'music',
          'is_delete' => false
        ],
        [
          'title' => 'culinary',
          'slug' => 'culinary',
          'is_delete' => false
        ],
        [
          'title' => 'sports',
          'slug' => 'sports',
          'is_delete' => false
        ],
        [
          'title' => 'traveling',
          'slug' => 'traveling',
          'is_delete' => false
        ],
        [
          'title' => 'general',
          'slug' => 'general',
          'is_delete' => false
        ],
      ]);

      factory(Faq::class, 4)->create();
      factory(Testimoni::class, 4)->create();
      factory(Content::class, 10)->create();
      factory(ContentFile::class, 20)->create();

      // //primary content
      // foreach ($this->primaryContents as $primaryContent) {
      //   $file = $faker->image('storage/app/public/content', 640, 480, null, true);
      //   $file = str_replace('storage/app/public/content\\', '/content/', $file);

      //   Content::where('slug', $primaryContent)->update([
      //     'description' => $faker->randomHtml(2,3),
      //     'thumbnail' => $file
      //   ]);
      // }

      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
