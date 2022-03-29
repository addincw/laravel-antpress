<?php

namespace App\Http\controllers\Backsite\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Configuration;

class ConfigurationController extends Controller
{
  private $route = 'backsite/site/configuration';

  public function index ()
  {
    $params['route'] = $this->route;
    $params['profile'] = Configuration::first();
    return view('backsite.site.configuration', $params);
  }

  public function store (Request $request)
  {
    try {
      $profile = Configuration::find($request->id);
      $logo = !empty($profile) ? $profile->logo : null;
      $logoFull = !empty($profile) ? $profile->logo_full : null;

      $request->session()->flash('status', [
        'code' => 'success',
        'message' => 'Kontak berhasil di perbarui',
      ]);


      if ($request->hasFile('logo')) {
        $logo = $request->file('logo')->store('site', 'public');
      }
      if ($request->hasFile('logo_full')) {
        $logoFull = $request->file('logo_full')->store('site', 'public');
      }

      if (!empty($profile)) {
        $profile->update([
          'title' => $request->name,
          'description' => $request->description,
          'phone' => $request->phone,
          'whatsapp' => $request->whatsapp,
          'telegram' => $request->telegram,
          'address' => $request->address,
          'email' => $request->email,
          'facebook' => $request->facebook,
          'twitter' => $request->twitter,
          'instagram' => $request->instagram,
          'youtube' => $request->youtube,
          'logo' => $logo,
          'logo_full' => $logoFull,
        ]);

        return redirect($this->route);
      }

      Configuration::create([
        'title' => $request->name,
        'description' => $request->description,
        'phone' => $request->phone,
        'whatsapp' => $request->whatsapp,
        'telegram' => $request->telegram,
        'address' => $request->address,
        'email' => $request->email,
        'facebook' => $request->facebook,
        'twitter' => $request->twitter,
        'instagram' => $request->instagram,
        'youtube' => $request->youtube,
        'logo' => $logo,
        'logo_full' => $logoFull,
      ]);
    } catch (\Exception $e) {
      $request->session()->flash('status', [
        'code' => 'warning',
        'message' => 'Kontak gagal di perbarui : ' . $e->getMessage(),
      ]);
      return redirect()->back();
    }

    return redirect($this->route);
  }
}
