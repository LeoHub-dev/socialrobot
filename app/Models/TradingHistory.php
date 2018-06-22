<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Debugbar;

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
                else if($trading_loop->result == 2){
                    $trading_total--;
                }

                $trading_n++;
                
            }

            Debugbar::info($trading_total);

            if($trading_n == 0) : $trading_n = 1; endif;

            $user_trading->reputation = floor(($trading_total / $trading_n) * 100);
            $user_trading->save();

            foreach($user_trading->followers()->get() as $follower) {

                /*$follow->actionhistories()->create([
                    'trading_id' => $trading->id,
                    'amount' => '100',
                    'result' => $request->result
                ]);*/

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
                else if($trading->result == 2){
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
