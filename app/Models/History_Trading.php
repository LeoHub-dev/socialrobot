<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class History_Trading extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
