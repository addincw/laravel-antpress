<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Visitors\MainController;

use App\Models\Profile;
use App\Models\Testimoni;
use App\Models\Contents\ContentFile;
use App\Models\Contents\Content;

class ProfileController extends MainController
{
  protected $route = '/';
  protected $routeView = 'pages.visitors';

  public function __construct ()
  {
    parent::__construct();
    $this->params['route'] = $this->route;
  }
  public function show($slug)
  {
    $this->params['content'] = Content::where('slug', $slug)->first();

    if (empty($this->params['content'])) {
      return redirect('/');
    }

    return view($this->routeView . '.profile', $this->params);
  }
}
