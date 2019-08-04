<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Profile;
use App\Models\Testimoni;
use App\Models\Contents\ContentFile;
use App\Models\Contents\Content;

class ProfileController extends Controller
{
  private $route = '/';
  private $routeView = 'pages.visitors';
  private $params = [];

  public function __construct ()
  {
    $this->params['route'] = $this->route;
  }
  public function show($slug)
  {
    $this->params['content'] = Content::where('slug', $slug)->first();

    if (empty($this->params['content'])) {
      return redirect('/');
    }

    // profile
    $this->params['profile'] = Profile::first();

    // content files: type image order by created at
    $this->params['recentGalleries'] = ContentFile::where('file_type', 'like', 'image%')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(9)->get();

    return view($this->routeView . '.profile', $this->params);
  }
}
