<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use \App\User;

use \App\Models\Site\Configuration;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');

      User::truncate();
      Configuration::truncate();

      factory(User::class)->create();
      factory(Configuration::class)->create();

      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
