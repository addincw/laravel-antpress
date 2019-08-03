<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Contents\Content;
use App\Models\Clinics\Clinic;
use App\Models\Contents\ContentFile;
use App\Models\Doctor;
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
    $doctors = Doctor::query()->where('is_active', true);
    // content_files: is_highlight true, type image
    $this->params['banners'] = ContentFile::where('is_highlight', true)
                               ->where('file_type', 'like', 'image%')
                               ->get();

    // content: tentang kami
    $this->params['aboutUs'] = Content::where('slug', 'sejarah')->first();

    // count
    $this->params['countClinic'] = Clinic::all()->count();
    $this->params['countDoctor'] = $doctors->get()->count();

    // content: type blog
    $this->params['blogs'] = Content::where('is_published', true)
                             ->where('type', 'blog')
                             ->orderBy('created_at', 'desc')
                             ->limit(3)
                             ->get();

    // doctors
    $this->params['doctors'] = $doctors->limit(4)->get();

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
