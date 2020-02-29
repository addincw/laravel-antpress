<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Visitors\MainController;

use App\Models\Testimoni;
use App\Models\Faq;
use App\Models\Contents\Content;
use App\Models\Contents\ContentFile;
use App\Models\Clinics\Clinic;
use App\Models\Doctor;

class LandingPageController extends MainController
{
  protected $route = '/';
  protected $routeView = 'pages.visitors';

  public function __construct ()
  {
    parent::__construct();
    $this->params['route'] = $this->route;

    // testimoni
    $this->params['testimonies'] = Testimoni::all();
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

    // content: type blog
    $this->params['blogs'] = Content::where('is_published', true)
                             ->where('type', 'blog')
                             ->orderBy('created_at', 'desc')
                             ->limit(3)
                             ->get();

    // contentFIle: type video
    $this->params['video'] = ContentFile::where('file_type', 'video')
                             ->where('is_highlight', true)
                             ->first();

    // doctors
    $this->params['doctors'] = $doctors->limit(4)->get();
    
    // faqs
    $this->params['faqs'] = Faq::limit(4)->get();

    //filters
    $this->params['filterSpecialist'] = '';
    $this->params['filterName'] = '';

    return view($this->routeView . '.index', $this->params);
  }
}
