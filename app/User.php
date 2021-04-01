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
use App\Models\Crop;
use App\Models\Product;
use App\Models\Product_apply;
use App\Models\Bayer;
use App\Models\Sale;
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
        'name', 'email', 'password','image','competence_id'
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

    public function crop()
    {
        return $this->hasMany(crop::class);
    }

    public function product()
    {
        return $this->hasMany(product::class);
    }

    public function bayer()
    {
        return $this->hasMany(bayer::class);
    }

    public function sale()
    {
        return $this->hasMany(sale::class);
    }

    public function product_apply()
    {
        return $this->hasMany(product_apply::class);
    }

}
