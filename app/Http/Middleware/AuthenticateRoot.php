<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateRoot
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
        // var_dump($guard);

        $roles = Auth::guard($guard)->user()->hasRole('root');

        if (Auth::guard($guard)->guest() || !$roles) {
            return redirect('/subscriber');
        }

        // if (Auth::guard($guard)->guest() || !Auth::guard($guard)->user()->hasRole('root')) {
        // if ($request->ajax() || $request->wantsJson()) {
        //     return response('Unauthorized', 401);
        // } else {
        //     return abort(401);
        // }
        // }

        return $next($request);
    }
}
