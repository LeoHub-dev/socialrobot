<?php

namespace App\Http\Middleware;

use Closure;

class CheckInvoices
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
        if(Auth::user()->invoice()->where('paid',0)->count())
        {
            flash('Debes asignar un balance a invertir')->error()->important();
            return redirect('/app/settings');
        }

        return $next($request);
    }
}
