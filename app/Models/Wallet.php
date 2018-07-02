<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'amount'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($trading) {

            $user_wallet = User::find($trading->user_id);
            $user_wallet->wallet = floor(($trading_total / $trading_n) * 100);
            $user_wallet->save();
            
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
}
