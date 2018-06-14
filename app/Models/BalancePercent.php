<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BalancePercent extends Model
{
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
