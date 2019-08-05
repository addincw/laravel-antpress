<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Visitors\MainController;

use App\Models\Contents\Content;
use App\Models\Clinics\Clinic;
use App\Models\Doctor;

class DoctorController extends MainController
{
  protected $route = '/dokter';
  protected $routeView = 'pages.visitors.doctor';

  public function __construct ()
  {
    parent::__construct();
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
