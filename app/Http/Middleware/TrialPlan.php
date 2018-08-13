<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class TrialPlan
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
    	if(auth()->user()->user_plan == 'trial' && auth()->user()->created_at >= Carbon::now()->addDays(30)->toDateTimeString()) {
		    return redirect()->route('subscription.update');
	    }

        return $next($request);
    }
}
