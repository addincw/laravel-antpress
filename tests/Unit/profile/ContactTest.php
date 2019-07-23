<?php

namespace Tests\Unit\profile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/admin/profile/kontak');
        $response->assertOk();
    }

    public function testStore()
    {
      $faker = \Faker\Factory::create();

      $response = $this->json('post', '/admin/profile/kontak', [
        'title' => $faker->company,
        'description' => $faker->streetAddress,
        'phone' => $faker->phoneNumber,
        'address' => "$faker->streetAddress, $faker->city, $faker->postcode, $faker->state",
        'email' => $faker->email,
        'facebook' => $faker->email,
        'twitter' => $faker->email,
        'instagram' => $faker->email,
        'youtube' => $faker->email,
      ]);

      $response->assertOk();

    }
}
