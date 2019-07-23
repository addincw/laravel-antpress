<?php

namespace App\Models\Clinics;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
  protected $guarded = [];
  protected $appends = ['thumbnail_url'];

  public function getThumbnailUrlAttribute ()
  {
    try {
      return asset($this->attributes['thumbnail'] ? "/storage/".$this->attributes['thumbnail'] : "/img/no-image.png");
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }
}
