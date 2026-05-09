<?php

namespace App\Http\Controllers\Backsite\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Site\ConfigurationRepository;

class ConfigurationController extends Controller
{
  private $route = 'backsite/site/configuration';
  private $routeView = 'backsite.site.configuration';
  private $params = [];

  public function __construct() {
    $this->params['route'] = $this->route;
  }

  public function index ()
  {
    $this->params['data'] = ConfigurationRepository::load();
    return view($this->routeView, $this->params);
  }

  public function update (Request $request, $configurationId)
  {    
    try {
      ConfigurationRepository::updateById($configurationId, $request);
      flash_notif_success($this->routeView, __FUNCTION__);
    } catch (\Exception $e) {
      flash_notif_failed($this->routeView, __FUNCTION__, $e->getMessage());
      return redirect()->back();
    }

    return redirect($this->route);
  }
}
