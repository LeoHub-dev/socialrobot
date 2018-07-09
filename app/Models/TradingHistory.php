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
        'user_id', 'coins', 'amount', 'result',
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

            Debugbar::info($trading_total);

            if($trading_n == 0) : $trading_n = 1; endif;

            $user_trading->reputation = floor(($trading_total / $trading_n) * 100);
            $user_trading->save();

            foreach($user_trading->followers()->get() as $follower) {

                $actived_api = $follower->user()->apis()->where([['user_id',$follower->user()->get()->first()->id],['active',true]])->first();
                $bittrex = new Bittrex($actived_api->pub_key, $actived_api->secret_key);

                // Used to place a buy order in a specific market. Use buylimit to place limit orders. Make sure you have the proper permissions set on your API keys for this call to work
                $bittrex->buyLimit('BTC-LTC', 1.2, 1.3);

                // Used to place an sell order in a specific market. Use selllimit to place limit orders.
                $bittrex->sellLimit('BTC-LTC', 1.2, 1.3);


                $follower->user()->get()->first()->actionhistories()->create([
                    'trading_id' => $trading->id,
                    'amount' => $trading->amount
                ]);

                Debugbar::info($follower->user()->get()->first()->actionhistories());

                Debugbar::info($follower->user()->get());

                Debugbar::info($follower->user()->get()->first()->name);
                
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

    public function scopeSuccess($query)
    {
        return $query->where('result', 1);
    }
}
