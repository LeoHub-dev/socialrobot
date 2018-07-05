<?php

namespace App\Models;
use App\TradingHistory;
use Illuminate\Database\Eloquent\Model;

class ActionHistory extends Model
{
    protected $fillable = [
        'trading_id', 'user_id', 'amount', 'done',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tradingInfo()
    {
        return $this->belongsTo(TradingHistory::class)->withTimestamps();
    }
}
