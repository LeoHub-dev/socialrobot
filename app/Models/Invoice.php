<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	protected $fillable = [
        'user_id', 'amount', 'reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
