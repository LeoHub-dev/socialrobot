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
        
        //dd($bittrex->getMarkets());

        return view('app.orders.index', compact('orders','title','bittrex'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, ['coins' => 'required', 'buy_limit' => 'required|min:1|max:100', 'sell_limit' => 'required|min:1|max:100']);

        if($request->auto_order)
        {
            $actived_api = $follower->user()->apis()->where([['user_id',$follower->user()->get()->first()->id],['active',true]])->first();
            $bittrex = new Bittrex($actived_api->pub_key, $actived_api->secret_key);

            // Used to place a buy order in a specific market. Use buylimit to place limit orders. Make sure you have the proper permissions set on your API keys for this call to work
            $bittrex->buyLimit($trading->coin, $request->buy_limit, 1.3);

            // Used to place an sell order in a specific market. Use selllimit to place limit orders.
            $bittrex->sellLimit($trading->coin, $request->sell_limit, 1.3);
        }

        Auth::user()->tradinghistories()->create([
            'coins' => $request->coins,
            'buy_limit' => $request->buy_limit,
            'sell_limit' => $request->sell_limit
        ]);

        return redirect("/app/orders");

    }
}
