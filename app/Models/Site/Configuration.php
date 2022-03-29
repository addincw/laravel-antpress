<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
  protected $guarded = [];

  protected $appends = ['logo_url', 'logo_full_url'];

  public function getLogoUrlAttribute ()
  {
    try {
      return asset($this->attributes['logo'] ? "/storage/".$this->attributes['logo'] : "/img/no-image.png");
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }
  public function getLogoFullUrlAttribute ()
  {
    $assetLink = "/img/no-image.png";
    try {
      if ($this->attributes['logo_full']) {
        $assetLink = "/storage/".$this->attributes['logo_full'];
      }else if($this->attributes['logo']) {
        $assetLink = "/storage/".$this->attributes['logo'];
      }

      return asset($assetLink);
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }
}
