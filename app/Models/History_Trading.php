<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History_Trading extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
