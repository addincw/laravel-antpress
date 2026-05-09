<?php
use Illuminate\Support\Str;

if (! function_exists('site_config')) {
  /**
   * Get Session Site Configuration.
   *
   * @return \App\Model\Site\Configuration
   */
  function site_config()
  {
    return optional(request()->siteConfig);
  }
}
if (! function_exists('flash_notif_success')) {
  /**
   * Get Session flash notif success.
   *
   * @param $path
   * @param $method
   * @return String
   */
  function flash_notif_success($path, $method)
  {
    Session::flash('status', [
      'code' => 'success',
      'message' =>str_replace("/", " ", $path) . ' ' . past_tense($method),
    ]);
  }
}
if (! function_exists('flash_notif_failed')) {
  /**
   * Get Session flash notif failed.
   *
   * @param $path
   * @param $method
   * @return String
   */
  function flash_notif_failed($path, $method, $errMsg = "")
  {
    $message = str_replace("/", " ", $path) . ' failed to ' . past_tense($method);
    if ($errMsg) {
      $message .= ": {$errMsg}";
    }
    Session::flash('status', [ 'code' => 'warning', 'message' => $message ]);
  }
}
if (! function_exists('past_tense')) {
  /**
   * Get Session Site Configuration.
   *
   * @param $word
   * @return String
   */
  function past_tense($word)
  {
    $lastChar = substr($word, -1);
    $isVocal = in_array($lastChar, ['a', 'i', 'u', 'e', 'o']);

    return $word . ($isVocal ? 'd' : 'ed');
  }
}