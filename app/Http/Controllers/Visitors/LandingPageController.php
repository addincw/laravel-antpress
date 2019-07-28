<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Contents\Content;
use App\Models\Clinics\Clinic;
use App\Models\Contents\ContentFile;
use App\Models\Profile;
use App\Models\Testimoni;

class LandingPageController extends Controller
{
  private $route = '/';
  private $routeView = 'pages.visitors';
  private $params = [];

  public function __construct ()
  {
    $this->params['route'] = $this->route;
  }
  public function index ()
  {
    // content_files: is_highlight true, type image
    $this->params['banners'] = ContentFile::where('is_highlight', true)
                               ->where('file_type', 'like', 'image%')
                               ->get();

    // content: tentang kami
    $this->params['aboutUs'] = Content::where('slug', 'sejarah')->first();

    // count clinic
    $this->params['countClinic'] = Clinic::all()->count();

    // count staff
    //

    // content: type blog
    $this->params['blogs'] = Content::where('is_published', true)
                             ->where('type', 'blog')
                             ->orderBy('created_at', 'desc')
                             ->limit(3)
                             ->get();

    // testimoni
    $this->params['testimonies'] = Testimoni::all();

    // profile
    $this->params['profile'] = Profile::first();

    // content files: type image order by created at
    $this->params['recentGalleries'] = ContentFile::where('file_type', 'like', 'image%')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(9);

    return view($this->routeView . '.index', $this->params);
  }
}
