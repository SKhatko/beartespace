<?php

namespace App\Http\Middleware;

use Closure;

class HasDeliveryAddress
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
    	if(auth()->user() && session('delivery-address')) {
		    return $next($request);
	    } else {
		    return redirect( route( 'address' ));
	    }
    }
}
