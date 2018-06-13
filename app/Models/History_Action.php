<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class History_Action extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tradingInfo()
    {
        return $this->belongsTo(History_Trading::class)->withTimestamps();
    }

}
