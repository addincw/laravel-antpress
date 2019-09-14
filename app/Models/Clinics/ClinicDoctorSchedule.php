<?php

namespace App\Models\Clinics;

use Illuminate\Database\Eloquent\Model;

class ClinicDoctorSchedule extends Model
{
    protected $guarded = [];

    public function clinic_doctor ()
    {
        return $this->belongsTo('App\Models\Clinics\ClinicDoctor', 'clinic_doctor_id');
    }
    public function day ()
    {
        return $this->belongsTo('App\Models\Day', 'day_id');
    }
}
