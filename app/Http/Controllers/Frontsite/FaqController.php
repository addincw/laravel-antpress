<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontsite\MainController;

use App\Models\Site\Faq;

class FaqController extends MainController
{
  protected $route = '/';
  protected $routeView = 'frontsite';

  public function __construct ()
  {
    parent::__construct();
    $this->params['route'] = $this->route;
  }
  public function show($id)
  {
    $this->params['faq'] = Faq::find($id);

    if (empty($this->params['faq'])) {
      return redirect('/');
    }

    return view($this->routeView . '.faq', $this->params);
  }
}
