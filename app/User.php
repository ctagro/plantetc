<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Type_activity;
use App\Models\Activity;
use App\Models\Worker;
use App\Models\Account;
use App\Models\Accounting;
use App\Models\Ground;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    Use SoftDeletes;
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function type_activity()
    {
        return $this->hasMany(Type_activity::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }


    public function worker()
    {
        return $this->hasMany(Worker::class);
    }  
    
    public function account()
    {
        return $this->hasMany(account::class);
    }

    public function ground()
    {
        return $this->hasMany(ground::class);
    }

    public function accounting()
    {
        return $this->hasMany(accounting::class);
    }

}
