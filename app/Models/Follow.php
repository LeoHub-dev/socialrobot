<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
	protected $fillable = [
        'user_id', 'trader_id', 'percent_to_trader', 'base_amount', 'actual_amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function trader()
    {
        return $this->belongsTo(User::class, 'trader_id', 'id');
    }
}
