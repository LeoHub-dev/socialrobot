<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function trader()
    {
        return $this->belongsTo(User::class, 'id', 'trader_id');
    }
}
