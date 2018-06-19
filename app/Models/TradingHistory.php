<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class TradingHistory extends Model
{
	protected static function boot()
    {
        parent::boot();

        static::creating(function ($trading) {

        	$trading_total = 0;
        	$trading_count = 0;

            $user_trading = User::find($trading->user_id);
            foreach ($user_trading->tradinghistories() as $data) {
            	if($trading->result == 1): 
                    $trading_total++;
                elseif($trading->result == 2): 
                    $trading_total--;
                endif; 
                $trading_count++;
            }

            if($trading_count == 0) : $trading_count = 1; else : $trading_count = $trading_count; endif;

            $user_trading->reputation = floor(($trading_total / $trading_count) * 100);
            $user_trading->save();
            
        });

        static::updated(function ($trading) {

            $trading_total = 0;
        	$trading_count = 0;

            $user_trading = User::find($trading->user_id);
            foreach ($user_trading->tradinghistories() as $data) {
            	if($trading->result == 1): 
                    $trading_total++;
                elseif($trading->result == 2): 
                    $trading_total--;
                endif; 
                $trading_count++;
            }

            if($trading_count == 0) : $trading_count = 1; else : $trading_count = $trading_count; endif;

            $user_trading->reputation = floor(($trading_total / $trading_count) * 100);
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
