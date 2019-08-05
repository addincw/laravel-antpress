<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Visitors\MainController;

use App\Models\Contents\Content;
use App\Models\Clinics\Clinic;
use App\Models\Contents\ContentFile;
use App\Models\Doctor;
use App\Models\Profile;
use App\Models\Testimoni;

class ClinicController extends MainController
{
  protected $route = '/';
  protected $routeView = 'pages.visitors.clinic';

  public function __construct ()
  {
    parent::__construct();
    $this->params['route'] = $this->route;
  }

  public function index ()
  {
    $this->params['clinics'] = Clinic::where('is_published', true)->get();
    return view($this->routeView . '.index', $this->params);
  }

  public function show ($id)
  {
    $this->params['clinic'] = Clinic::find($id);

    return view($this->routeView . '._slug', $this->params);
  }
}
