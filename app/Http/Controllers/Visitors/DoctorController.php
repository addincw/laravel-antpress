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

class DoctorController extends Controller
{
  private $route = '/dokter';
  private $routeView = 'pages.visitors.doctor';
  private $params = [];

  public function __construct ()
  {
    // testimoni
    $this->params['testimonies'] = Testimoni::all();

    // profile
    $this->params['profile'] = Profile::first();

    // content files: type image order by created at
    $this->params['recentGalleries'] = ContentFile::where('file_type', 'like', 'image%')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(9)->get();

  }

  public function index ()
  {
    // doctors
    $this->params['doctors'] = Doctor::query()->where('is_active', true)->get();


    return view($this->routeView . '.index', $this->params);
  }

  public function show ($id)
  {
    $this->params['doctor'] = Doctor::find($id);

    return view($this->routeView . '._slug', $this->params);
  }
}
