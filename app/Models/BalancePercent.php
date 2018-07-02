<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use DB;

class BalancePercent extends Model
{
    protected $fillable = [
        'user_id', 'amount_base', 'amount_btc', 'amount_usd', 'percent_to_use',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($balance) {

            DB::table('balance_percents')->where('user_id', '=', $balance->user_id)->update(array('active' => false));
            
        });

        static::deleting(function ($user) {
            
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOld($query)
    {
        return $query->where('active', false);
    }

    public function getActiveAttribute()
    {
        return ($this->active) ? 'Yes' : 'No';
    }
}
