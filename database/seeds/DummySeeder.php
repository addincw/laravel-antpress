<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

use \App\Models\Profile;
use \App\Models\Doctor;
use \App\Models\Testimoni;
use \App\Models\Clinics\Clinic;
use \App\Models\Clinics\ClinicDoctor;
use \App\Models\Contents\Content;
use \App\Models\Contents\ContentCategory;
use \App\Models\Contents\ContentFile;

class DummySeeder extends Seeder
{
    private $primaryContents = ['umum', 'sejarah', 'visi-misi', 'fasilitas', 'indikator-mutu', 'kontak-kami'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      ClinicDoctor::truncate();
      Profile::truncate();
      Doctor::truncate();
      Clinic::truncate();

      \Storage::deleteDirectory('/content');
      \Storage::deleteDirectory('/doctor');
      \Storage::deleteDirectory('/clinic');
      \Storage::deleteDirectory('/testimoni');
      \Storage::deleteDirectory('/gallery');

      ContentCategory::insert([
        [
          'title' => 'kesehatan',
          'slug' => 'kesehatan',
        ],
        [
          'title' => 'pola makan',
          'slug' => 'pola-makan',
        ],
        [
          'title' => 'gaya hidup',
          'slug' => 'gaya-hidup',
        ],
        [
          'title' => 'tips',
          'slug' => 'tips',
        ],
        [
          'title' => 'tutorial',
          'slug' => 'tutorial',
        ]
      ]);

      factory(Content::class, 10)->create();
      factory(ContentFile::class, 20)->create();
      factory(Testimoni::class, 4)->create();
      factory(Profile::class)->create();
      factory(Clinic::class, 8)->create();
      factory(Doctor::class, 20)->create()->each(function ($doctor) {
          $doctor->clinics()->save(factory(ClinicDoctor::class)->make());
      });

      //primary content
      foreach ($this->primaryContents as $primaryContent) {
        $file = $faker->image('public/storage/content', 640, 480, null, true);
        $file = str_replace('public/storage/content\\', '/content/', $file);

        Content::where('slug', $primaryContent)->update([
          'description' => $faker->randomHtml(2,3),
          'thumbnail' => $file
        ]);
      }

      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
