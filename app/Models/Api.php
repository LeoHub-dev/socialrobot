<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    //
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
