<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class TradingHistory extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSuccess($query)
    {
        return $query->where('result', 1);
    }
}
