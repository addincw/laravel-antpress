<?php

namespace App\Http\Controllers\Admins\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;

class ContactController extends Controller
{
  private $route = 'admin/profile/kontak';

  public function index ()
  {
    $params['route'] = $this->route;
    $params['profile'] = Profile::first();
    return view('pages.admins.profiles.contact', $params);
  }

  public function store (Request $request)
  {
    try {
      $profile = Profile::find($request->id);
      $logo = !empty($profile) ? $profile->logo : null;

      $request->session()->flash('status', [
        'code' => 'success',
        'message' => 'Kontak berhasil di perbarui',
      ]);


      if ($request->hasFile('logo')) {
        $logo = $request->file('logo')->store('profile', 'public');
      }

      if (!empty($profile)) {
        $profile->update([
          'title' => $request->name,
          'description' => $request->description,
          'phone' => $request->phone,
          'address' => $request->address,
          'email' => $request->email,
          'facebook' => $request->facebook,
          'twitter' => $request->twitter,
          'instagram' => $request->instagram,
          'youtube' => $request->youtube,
          'logo' => $logo,
        ]);

        return redirect($this->route);
      }

      Profile::create([
        'title' => $request->name,
        'description' => $request->description,
        'phone' => $request->phone,
        'address' => $request->address,
        'email' => $request->email,
        'facebook' => $request->facebook,
        'twitter' => $request->twitter,
        'instagram' => $request->instagram,
        'youtube' => $request->youtube,
        'logo' => $logo,
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
