<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(Auth::check()) {

            if (!$request->user()->isAdmin())
            {
                return redirect('/')->with(\Session::flash('failure', 'You are not authorized to access this content.'));
            }

        }

        else return redirect('/')->with(\Session::flash('failure', 'You are not authorized to access this content.'));

        return $next($request);
    }
}
