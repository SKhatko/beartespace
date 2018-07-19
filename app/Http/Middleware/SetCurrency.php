<?php

namespace App\Http\Middleware;

use Closure;

class SetCurrency
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
	    session(['currency', (session('currency') ?? currency()->config( 'currency' ))]);

        return $next($request);
    }
}
