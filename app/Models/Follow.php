<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
	protected $fillable = [
        'user_id', 'trader_id', 'percent_to_trader',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function trader()
    {
        return $this->belongsTo(User::class, 'id', 'trader_id');
    }
}
