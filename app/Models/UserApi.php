<?php

namespace App\Models;
use App\User;
use App\Models\Api;
use DB;
use Illuminate\Database\Eloquent\Model;

class UserApi extends Model
{
    protected $fillable = ['id_user','name','api_category','secret_key','pub_key'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user_api) {

            DB::table('user_apis')->where('user_id', '=', $user_api->user_id)->update(array('active' => false));
            
        });

        static::deleting(function ($user) {
            
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function api()
    {
        return $this->belongsTo(Api::class, 'api_category', 'id');
    }
}
