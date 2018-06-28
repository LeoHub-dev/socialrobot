<?php

namespace App\Models;
use App\User;
use App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class UserApi extends Model
{
    protected $fillable = ['id_user','name','api_category','secret_key','pub_key'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function api()
    {
        return $this->belongsTo(Api::class, 'api_category', 'id');
    }
}
