<?php

namespace App\Http\Middleware;

use Closure;
use Alert;

class AdminCheck
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
        if(\Auth::User()->admin)
        {
            return $next($request);
        } else {
            Alert::error('You do not have permission to view this.');
            return redirect(route('frontend.index'));
        }

    }
}
