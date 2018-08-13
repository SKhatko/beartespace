<?php

namespace App\Http\Middleware;

use Closure;

class BasicPlan
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
	    if(auth()->user()->user_plan == 'basic' ) {
		    return redirect()->route('subscription.update');
	    }

        return $next($request);
    }
}
