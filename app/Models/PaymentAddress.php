<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PaymentAddress extends Model
{
    protected $fillable = [
        'user_id', 'coin', 'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
