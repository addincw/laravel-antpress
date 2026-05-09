<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Models\Site\Configuration;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(['username' => 'superadmin'], [
            'name' => 'superadmin',
            'email' => 'superadmin@antpress',
            'password' => \Hash::make('secret'),
            'remember_token' => str_random(10),
        ]);
        Configuration::updateOrCreate(['email' => 'info@antpress'], [
            'title' => 'Antpress',
            'description' => 'Alternative content management system (CMS) of wordpress, build with laravel. Developer oriented, give initial setup and common features of CMS. Easy to maintain, overrides, and custom with all of utilities provided by laravel.',
        ]);
    }
}
