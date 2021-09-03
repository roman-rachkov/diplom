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
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() && $request->user()->hasAccess('account')) {
            return $next($request);
        }
        if (!Auth::user() && trim($request->getRequestUri(), '/') != 'account') {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
