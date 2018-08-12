<?php

namespace App\Http\Middleware;

use Closure;

class ExpandedPlan
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
	    if(auth()->user()->user_plan == 'expanded' ) {
		    return redirect()->route('payment.plan.update');
	    }

        return $next($request);
    }
}
