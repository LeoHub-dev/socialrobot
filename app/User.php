<?php

namespace App;

use App\Models\Balance_Percent;
use App\Models\Follow;
use App\Models\History_Trading;
use App\Models\History_Action;
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

    public function wallet()
    {
        return $this->has(Wallet::class);
    }

    public function Balance_Percent()
    {
        return $this->has(Balance_Percent::class);
    }

    public function history_tradings()
    {
        return $this->hasMany(History_Trading::class);
    }

    public function history_actions()
    {
        return $this->hasMany(History_Action::class);
    }

    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
