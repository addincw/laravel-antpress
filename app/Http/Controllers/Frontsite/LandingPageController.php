<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontsite\MainController;

use App\Models\Contents\Content;
use App\Models\Contents\ContentFile;
use App\Models\Feedback\Testimoni;
use App\Models\Site\Faq;

class LandingPageController extends MainController
{
  protected $route = '/';
  protected $routeView = 'frontsite';

  public function __construct ()
  {
    parent::__construct();
    $this->params['route'] = $this->route;

    // testimoni
    $this->params['testimonies'] = Testimoni::all();
  }

  public function index ()
  {
    // content_files: is_highlight true, type image
    $this->params['banners'] = ContentFile::where('is_highlight', true)
                               ->where('file_type', 'like', 'image%')
                               ->get();

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
    
    // faqs
    $this->params['faqs'] = Faq::limit(4)->get();

    return view($this->routeView . '.index', $this->params);
  }
}
