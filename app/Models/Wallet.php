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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($data) {

            $user_wallet = User::find($data->user_id);
            $user_wallet->wallet = $user_wallet->wallet + $data->amount;
            $user_wallet->save();
            
        });

        static::updated(function ($data) {

            $user_wallet = User::find($data->user_id);
            $user_wallet->wallet = $user_wallet->wallet + $data->amount;
            $user_wallet->save();

        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
