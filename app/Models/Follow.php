<?php

namespace App\Models;
use App\User;
use App\Models\BalancePercent;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
	protected $fillable = [
        'user_id', 'trader_id', 'percent_to_trader', 'base_amount', 'actual_amount', 'orders_amount'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($follow) {

            $balance = BalancePercent::find($follow->user_id);
            $balance->amount_btc = $balance->amount_btc - $follow->actual_amount;
            $balance->save();
            
        });

        static::deleting(function ($follow) {
            
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function trader()
    {
        return $this->belongsTo(User::class, 'trader_id', 'id');
    }
}
