<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
  protected $table = "site_configurations";
  
  protected $guarded = [];
  protected $appends = ['logo_url', 'favicon_url'];

  public function getFaviconUrlAttribute ()
  {
    try {
      return asset($this->attributes['favicon'] ? "/storage/".$this->attributes['favicon'] : "/img/no-image.png");
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }
  public function getLogoUrlAttribute ()
  {
    try {
      return asset($this->attributes['logo'] ? "/storage/".$this->attributes['logo'] : "/img/no-image.png");
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }
}
