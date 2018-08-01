<?php

namespace App\Models;
use App\User;
use App\Models\UserApi;
use App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Debugbar;
use Messerli90\Bittrex\Bittrex;

class TradingHistory extends Model
{
    protected $fillable = [
        'user_id', 'coins', 'amount', 'result', 'buy_limit', 'sell_limit', 'stop_loss'
    ];

	protected static function boot()
    {
        parent::boot();

        static::created(function ($trading) {

        	$trading_total = 0;
        	$trading_n = 0;

            $user_trading = User::find($trading->user_id);

            foreach($user_trading->tradinghistories()->get() as $trading_loop) {

                if($trading_loop->result == 1){
                    $trading_total++;
                }
                else if($trading_loop->result == 0){
                    $trading_total--;
                }

                $trading_n++;
                
            }

            if($trading_n == 0) : $trading_n = 1; endif;

            $user_trading->reputation = floor(($trading_total / $trading_n) * 100);
            $user_trading->save();

            foreach($user_trading->followers()->get() as $follower) {

                if($follower->orders_amount >= 1 && $follower->actual_amount/$follower->orders_amount >= $trading->buy_limit) //User has anough to pay
                {
                    $actived_api = $follower->user()->apis()->where('active',true)->first();
                    $bittrex = new Bittrex($actived_api->pub_key, $actived_api->secret_key);
    
                    // Used to place a buy order in a specific market. Use buylimit to place limit orders. Make sure you have the proper permissions set on your API keys for this call to work
                    $buy_response = $bittrex->buyLimit($trading->coin, $trading->buy_limit, 1.3);
    
                    if($buy_response->success)
                    {
                        $buy_uuid = $buy_response->result->uuid;
    
                        $follower->user()->get()->first()->actionhistories()->create([
                            'trading_id' => $trading->id,
                            'amount' => $trading->buy_limit,
                            'buy_uuid' => $buy_uuid
                        ]);

                        $follower->actual_amount = $follower->actual_amount - $trading->buy_limit;
                        $follower->orders_amount = $follower->orders_amount - 1;
                        $follower->save();
                    }
                }
                else
                {
                    //User need money to pay
                }
                
            }
            
        });

        static::updated(function ($trading) {

            $trading_total = 0;
            $trading_n = 0;

            $user_trading = User::find($trading->user_id);

            foreach($user_trading->tradinghistories()->get() as $trading) {

                if($trading->result == 1){
                    $trading_total++;
                }
                else if($trading->result == 0){
                    $trading_total--;
                }

                $trading_n++;
                
            }

            if($trading_n == 0) : $trading_n = 1; endif;

            $user_trading->reputation = floor(($trading_total / $trading_n) * 100);
            $user_trading->save();

        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUnsuccess($query)
    {
        return $query->where('result', 0);
    }

    public function scopeSuccess($query)
    {
        return $query->where('result', 1);
    }
}
