<?php

namespace App\Http\controllers\Backsite\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;

class ProfileController extends Controller
{
  private $route = 'backsite/profile/profile';

  public function index ()
  {
    $params['route'] = $this->route;
    $params['profile'] = Profile::first();
    return view('backsite.profiles.profile', $params);
  }

  public function store (Request $request)
  {
    try {
      $profile = Profile::find($request->id);
      $logo = !empty($profile) ? $profile->logo : null;
      $logoFull = !empty($profile) ? $profile->logo_full : null;

      $request->session()->flash('status', [
        'code' => 'success',
        'message' => 'Kontak berhasil di perbarui',
      ]);


      if ($request->hasFile('logo')) {
        $logo = $request->file('logo')->store('profile', 'public');
      }
      if ($request->hasFile('logo_full')) {
        $logoFull = $request->file('logo_full')->store('profile', 'public');
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

      Profile::create([
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
