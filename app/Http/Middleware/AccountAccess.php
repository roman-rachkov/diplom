<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if(Auth::user() && $request->user()->hasAccess($permission)) {
            return $next($request);
        }
        if (trim($request->getRequestUri() != 'login')) {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
