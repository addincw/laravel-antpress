<?php

namespace App\Models\Clinics;

use Illuminate\Database\Eloquent\Model;

class ClinicDoctor extends Model
{
    protected $guarded = [];

    public function clinic ()
    {
      return $this->belongsTo('App\Models\Clinics\Clinic', 'clinic_id');
    }

    public function doctor ()
    {
      return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }
}
