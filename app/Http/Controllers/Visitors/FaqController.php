<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Visitors\MainController;

use App\Models\Faq;

class FaqController extends MainController
{
  protected $route = '/';
  protected $routeView = 'pages.visitors';

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
