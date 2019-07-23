<?php

namespace App\Models\Contents;

use Illuminate\Database\Eloquent\Model;

class ContentTag extends Model
{
  protected $guarded = [];
  public function tag ()
  {
    return $this->belongsTo('App\Models\Tag', 'tag_id');
  }
}
