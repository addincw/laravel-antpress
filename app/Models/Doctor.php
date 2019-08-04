<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
  protected $guarded = [];
  protected $appends = ['image_url'];

  public function getImageUrlAttribute ()
  {
    try {
      return asset($this->attributes['image'] ? "/storage/".$this->attributes['image'] : "/img/no-image.png");
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }

  public function clinics ()
  {
    return $this->hasMany('App\Models\Clinics\ClinicDoctor', 'doctor_id');
  }
}
