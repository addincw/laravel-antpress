<?php
namespace App\Repositories\Site;

use App\Models\Site\Configuration;

class ConfigurationRepository
{
  public static function load()
  {
    return Configuration::first();
  }

  public static function updateById($id, $request)
  {
    $siteConfig = Configuration::find($id);
    $payload = [
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
      'logo' => optional($siteConfig)->logo,
      'favicon' => optional($siteConfig)->favicon,
    ];

    if ($request->hasFile('logo')) {
      $payload['logo'] = $request->file('logo')->store('site', 'public');
    }
    if ($request->hasFile('favicon')) {
      $payload['favicon'] = $request->file('favicon')->store('site', 'public');
    }

    $siteConfig->update($payload);
  }
}
