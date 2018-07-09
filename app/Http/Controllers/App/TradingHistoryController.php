<?php

namespace App\Http\Controllers\App;

use App\Models\TradingHistory;
use App\User;
use Messerli90\Bittrex\Bittrex;
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
        $bittrex = new Bittrex(null, null);
        
        dd($bittrex->getMarkets());

        return view('app.orders.index', compact('orders','title','bittrex'));
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
