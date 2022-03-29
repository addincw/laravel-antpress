<?php

namespace App\Http\controllers\Frontsite;

use Illuminate\Http\Request;
use App\Http\controllers\Frontsite\MainController;

use App\Models\Site\Configuration;
use App\Models\Testimoni;
use App\Models\Contents\ContentFile;
use App\Models\Contents\Content;

class ConfigurationController extends MainController
{
  protected $route = '/site';
  protected $routeView = 'frontsite';
  private $types = [
    'image' => [
      'name' => 'Images',
      'ext' => 'image'
    ],
    'video' => [
      'name' => 'Videos',
      'ext' => 'video'
    ],
  ];

  public function __construct ()
  {
    parent::__construct();
    $this->params['route'] = $this->route;
  }
  public function show($slug, Request $request)
  {
    $this->params['types'] = $this->types;
    $this->params['content'] = Content::where('slug', $slug)->first();

    if (empty($this->params['content'])) {
      return redirect('/');
    }

    $query = ContentFile::query();
    $query = $query->where('content_id', $this->params['content']->id);
    
    if ( empty($request->type_file) ) {
      $this->params['typeFile'] = 'image';
      $query = $query->where('file_type', 'like', "image%");
    }else{
      $this->params['typeFile'] = $request->type_file;
      $query = $query->where('file_type', 'like', $request->type_file . "%");
    }
    
    $this->params['galeries'] = $query->paginate(12);

    return view($this->routeView . '.profile', $this->params);
  }
}
