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
      $request->session()->flash('status', [
        'code' => 'success',
        'message' => 'Kontak berhasil di perbarui',
      ]);

      if (!empty($request->id)) {
        Profile::find($request->id)->update([
          'title' => $request->name,
          'description' => $request->description,
          'phone' => $request->phone,
          'address' => $request->address,
          'email' => $request->email,
          'facebook' => $request->facebook,
          'twitter' => $request->twitter,
          'instagram' => $request->instagram,
          'youtube' => $request->youtube
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
        'youtube' => $request->youtube
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
