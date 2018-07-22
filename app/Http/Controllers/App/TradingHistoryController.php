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
        $this->validate($request, [
            'coins' => 'required', 
            'amount' => 'required|min:0|max:100', 
            'buy_limit' => 'required|min:0|max:100', 
            'sell_limit' => 'required|min:0|max:100',
            'stop_loss' => 'required|min:0|max:100'
            ]);


        Auth::user()->tradinghistories()->create([
            'coins' => $request->coins,
            'amount' => $request->amount,
            'buy_limit' => $request->buy_limit,
            'sell_limit' => $request->sell_limit,
            'stop_loss' => $request->stop_loss,
            'buy_uuid' => $buy_uuid
        ]);

        if($request->auto_order)
        {
            $actived_api = Auth::apis()->where('active',true)->first();
            $bittrex = new Bittrex($actived_api->pub_key, $actived_api->secret_key);

            // Used to place a buy order in a specific market. Use buylimit to place limit orders. Make sure you have the proper permissions set on your API keys for this call to work
            $buy_response = $bittrex->buyLimit($trading->coin, $request->buy_limit, 1.3);

            if($buy_response->success)
            {
                $buy_uuid = $buy_response->result->uuid;
            }
            else
            {
                return redirect()->back()->withErrors(["Error al hacer orden"]);
            }

            Auth::actionhistories()->create([
                'trading_id' => $trading->id,
                'amount' => $trading->buy_limit
            ]);

            // Used to place an sell order in a specific market. Use selllimit to place limit orders.
            //$bittrex->sellLimit($trading->coin, $request->sell_limit, 1.3);
        }

        return redirect("/app/orders");

    }
}
