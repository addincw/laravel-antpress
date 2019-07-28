<?php

namespace App\Models\Contents;

use Illuminate\Database\Eloquent\Model;

class ContentFile extends Model
{
  protected $guarded = [];
  protected $appends = ['file_url'];

  public function getFileUrlAttribute ()
  {
    try {
      return asset($this->attributes['file'] ? "/storage/".$this->attributes['file'] : "/img/no-image.png");
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }
}
