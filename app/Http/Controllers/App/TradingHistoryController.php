<?php

namespace App\Http\Controllers\App;

use App\Models\TradingHistory;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TradingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Ordenes';

        $orders = Auth::user()->tradinghistories()->paginate(10);

        return view('app.orders.index', compact('orders','title'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, ['coins' => 'required', 'amount' => 'required']);

        Auth::user()->tradinghistories()->create([
            'coins' => $request->coins,
            'amount' => $request->amount
        ]);

        return redirect("/app/orders");

    }
}
