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
                $actived_api = $order_copy->user()->apis()->where([['user_id',$order_copy->user()->get()->first()->id],['active',true]])->first();
                $user_bittrex = new Bittrex($actived_api->pub_key, $actived_api->secret_key);

                if($order_copy->sell_uuid == NULL)
                {
                    $buy_order = $user_bittrex->getOrder($order_copy->buy_uuid);
                    if($buy_order->success)
                    {
                        if(!$buy_order->result->isOpen)
                        {
                            $sell_order = $user_bittrex->sellLimit($order->coins, $order->sell_limit, 1.3);
                            $order_copy->sell_uuid = $sell_order->result->uuid;
                            $order_copy->save();
                        }
                    }
                }
                else if($order->stop_loss == $coins_list[$order->coins]->last)
                {
                    $user_bittrex->cancel($order_copy->sell_uid);
                    $user_bittrex->sellLimit($order->coins, $coins_list[$order->coins]->last, 1.3);
                }
            }
            
        }
    }

}
