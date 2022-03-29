<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Configuration;

class IsAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
          $request->merge([
            'profile' => Configuration::first()
          ]);

          return $next($request);
        }
        
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'anda belum login',
        ]);
        return redirect('/backsite/login');
    }
}
