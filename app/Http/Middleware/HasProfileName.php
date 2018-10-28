<?php

namespace App\Http\Middleware;

use Closure;

class HasProfileName
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
    	if(auth()->user() && auth()->user()->user_name) {
		    return $next($request);
	    } else {
    		return redirect(route('sell.profile-name'));
	    }
    }
}
