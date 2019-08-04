<?php

use Faker\Generator as Faker;

use App\Models\Clinics\Clinic;

$factory->define(App\Models\Clinics\ClinicDoctor::class, function (Faker $faker) {
    $clinic = Clinic::inRandomOrder()->limit(5)->first();
    return [
      'clinic_id' => $clinic->id,
    ];
});
