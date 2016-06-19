<?php

namespace App\Http\Middleware;

use Closure;
use Input;

class RegistrationMiddleware
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
        $data = $request->all();

        $passphrase = $data['registration_code'];

        if($passphrase != env('PASS_PHRASE')) {

            return redirect()->back()->with(\Session::flash('failure', 'Invalid code'));

        }

        return $next($request);
    }
}
