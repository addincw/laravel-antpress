<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $table = 'profiles';
  protected $guarded = [];

  protected $appends = ['logo_url'];

  public function getLogoUrlAttribute ()
  {
    try {
      return asset($this->attributes['logo'] ? "/storage/".$this->attributes['logo'] : "/img/no-image.png");
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }
}
