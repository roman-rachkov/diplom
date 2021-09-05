<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        if($request->user() && $request->user()->hasAccess('account')) {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
