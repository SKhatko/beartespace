<?php

namespace App\Http\Middleware;

use Closure;

class HasPaymentMethod
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
    	if(auth()->user()->hasBraintreeId() && auth()->user()->paymentMethod()) {
		    return $next($request);
	    } else {
    		return redirect()->route('cart.payment');
	    }
    }
}
