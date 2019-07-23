<?php

namespace App\Models\Contents;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  protected $guarded = [];
  protected $appends = ['thumbnail_url', 'creator_image_url'];

  public function getThumbnailUrlAttribute ()
  {
    try {
      return asset($this->attributes['thumbnail'] ? "/storage/".$this->attributes['thumbnail'] : "/img/no-image.png");
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }
  public function getCreatorImageUrlAttribute ()
  {
    try {
      return asset($this->attributes['creator_image'] ? "/storage/".$this->attributes['creator_image'] : "/img/no-image.png");
    } catch (\Exception $e) {
      return asset("/img/no-image.png");
    }
  }

  public function category ()
  {
    return $this->belongsTo('App\Models\Contents\ContentCategory', 'content_category_id');
  }
  public function tags ()
  {
    return $this->hasMany('App\Models\Contents\ContentTag', 'content_id');
  }
  public function comments ()
  {
    return $this->hasMany('App\Models\Contents\ContentComment', 'content_id');
  }
}
