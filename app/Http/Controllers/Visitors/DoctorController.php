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

  public function index (Request $request)
  {
    $filter = [];
    $where = '1=1';
    $this->params['filterSpecialist'] = '';
    $this->params['filterName'] = '';

    if($request->submit === 'with_filter') {

      if(!empty($request->doctor_name)) {
        $filter[] = 'lower(name) like lower("%' . $request->doctor_name . '%")';
        $this->params['filterName'] = $request->doctor_name;
      }

      if(!empty($request->doctor_specialist)) {
        $filter[] = 'lower(specialist) like lower("%' . $request->doctor_specialist . '%")';
        $this->params['filterSpecialist'] = $request->doctor_specialist;
      }

      $where = '(' . implode(' and ', $filter) . ')';
    }

    // doctors
    $this->params['doctors'] = Doctor::query()
                                  ->where('is_active', true)
                                  ->whereRaw($where)
                                  ->get();


    return view($this->routeView . '.index', $this->params);
  }

  public function show ($id)
  {
    $this->params['doctor'] = Doctor::find($id);

    return view($this->routeView . '._slug', $this->params);
  }
}
