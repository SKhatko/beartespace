<?php

namespace App\Http\Middleware;

use Closure;

class Seller
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
	    if(auth()->user() && auth()->user()->seller_status === 'active') {
		    return $next($request);
	    } else {
		    return redirect( route( '/' ) )->with( 'error', trans( 'app.access_restricted' ) );
	    }
    }
}
