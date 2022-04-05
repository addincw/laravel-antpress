<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Site\Configuration;
use App\Models\Contents\ContentFile;

class MainController extends Controller
{
  protected $route = '';
  protected $routeView = '';
  protected $params = [];

  public function __construct ()
  {
    // profile
    $this->params['profile'] = Configuration::first();

    // content files: type image order by created at
    $this->params['recentGalleries'] = ContentFile::where('file_type', 'like', 'image%')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(9)->get();
  }
}
