<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()->invoices()->where('paid',0)->count())
        {
            flash('Debes pagar tus facturas')->error()->important();
            return redirect('/app/invoices');
        }

        return $next($request);
    }
}
