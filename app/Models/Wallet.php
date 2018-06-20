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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
