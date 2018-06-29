<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckApi
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
        if(!Auth::user()->apis()->where('active',1)->count() )
        {
            flash('Debes agregar una API')->error()->important();

            return redirect('/app/settings');
        }

        return $next($request);
    }
}
