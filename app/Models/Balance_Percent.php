<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance_Percent extends Model
{
    //


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
