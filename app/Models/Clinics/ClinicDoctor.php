<?php

namespace App\Models\Clinics;

use Illuminate\Database\Eloquent\Model;

class ClinicDoctor extends Model
{
    protected $guarded = [];

    public function doctor ()
    {
      return $this->hasMany('App\Models\Doctor', 'doctor_id');
    }
}
