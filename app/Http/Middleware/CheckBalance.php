<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckBalance
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
        if(!Auth::user()->balancepercents()->where('active',1)->count())
        {
            flash('Debes asignar un balance a invertir')->error()->important();
            return redirect('/app/settings');
        }

        return $next($request);
    }
}
