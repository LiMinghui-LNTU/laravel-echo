<?php

namespace App\Http\Middleware;

use Closure;

class MemberMiddleware
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
        if (session()->get('member')) {
            return $next($request);
        }
        return redirect('/login');
    }
}
