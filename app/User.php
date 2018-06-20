<?php

namespace App;

use App\Models\Api;
use App\Models\BalancePercent;
use App\Models\Follow;
use App\Models\TradingHistory;
use App\Models\ActionHistory;
use App\Models\Invoice;
use App\Models\Wallet;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait; // add this trait to your user model
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            
        });

        static::deleting(function ($user) {
            
        });
    }

    public function wallet()
    {
        return $this->hasMany(Wallet::class);
    }

    public function balancepercents()
    {
        return $this->hasMany(BalancePercent::class);
    }

    public function tradinghistories()
    {
        return $this->hasMany(TradingHistory::class);
    }

    public function actionhistories()
    {
        return $this->hasMany(ActionHistory::class);
    }

    public function follows()
    {
        return $this->hasMany(Follow::class, 'user_id', 'id');
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'trader_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function apis()
    {
        return $this->belongsToMany(Api::class)->withTimestamps();
    }


}
