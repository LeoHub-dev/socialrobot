<?php

namespace App\Models;
use App\UserApi;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    //
    protected $fillable = ['name'];

    public function api()
    {
        return $this->belongsToMany(UserApi::class);
    }
}
