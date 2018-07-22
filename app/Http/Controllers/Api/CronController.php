<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\TradingHistory;
use App\Models\ActionHistory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Messerli90\Bittrex\Bittrex;


class CronController extends Controller
{
    public function checkOrders()
    {
        /*$actived_api = Auth::user()->apis()->where([['user_id',Auth::id()],['active',true]])->first();

        if($actived_api)
        {
            $bittrex = new Bittrex($actived_api->pub_key, $actived_api->secret_key);
            $balance = $bittrex->getBalance('BTC');
            Debugbar::info($bittrex->getBalance('BTC'));
        }*/

        //dd(TradingHistory::Unsuccess()->get());

        $bittrex = new Bittrex(null, null);
        $coins_list = array();

        foreach (TradingHistory::Unsuccess()->get() as $order) 
        {
            if(!in_array($order->coins, $coins_list)) 
            {
                if($bittrex->getTicker($order->coins)) 
                {
                    $coins_list[$order->coins] = $bittrex->getTicker($order->coins)->result;
                }
            }

            foreach (ActionHistory::where('trading_id', $order->id)->get() as $order_copy) 
            {
                if($order->stop_loss == $coins_list[$order->coins]->last)
                {
                    $actived_api = $order_copy->user()->apis()->where([['user_id',$order_copy->user()->get()->first()->id],['active',true]])->first();
                    $bittrex = new Bittrex($actived_api->pub_key, $actived_api->secret_key);
                    $user_bittrex->cancel($order_copy->sell_uid);
                    $user_bittrex->sellLimit($order->coins, $coins_list[$order->coins]->last, 1.3);
                }
            }
            
        }

        dd($coins_list);

    }

}
