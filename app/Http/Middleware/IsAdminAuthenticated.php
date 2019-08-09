<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Profile;

class IsAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->merge([
          'profile' => Profile::first()
        ]);

        return $next($request);
    }
}
