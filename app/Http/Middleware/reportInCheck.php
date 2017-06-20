<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class reportInCheck
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();

        // If User model has a member then check if they reported in
        if ($user) {
            if(isset($user->member) && !$user->member->hasReportedIn())
            {
                flash('You have not reported in, please report in!','danger');
            }
            return redirect(route('frontend.files.my-file'));
        }

        return $next($request);
    }
}
