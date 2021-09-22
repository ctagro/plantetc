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
use App\Models\Pesticide;
use App\Models\Pesticide_apply;
use App\Models\Disease;
use App\Models\Active_principle;
use App\Models\Category_pesticide;
Use App\Models\Bank;
Use App\Models\CashFlow;
Use App\Models\Type_product;
Use App\Models\Entry;
Use App\Models\Provide;
Use App\Models\Fertilizer_inventory;
Use App\Models\Fertilizer_entry;
Use App\Models\Pesticide_inventory;
Use App\Models\Pesticide_entry;

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

    public function pesticide()
    {
        return $this->hasMany(pesticide::class);
    }

    public function pesticide_apply()
    {
        return $this->hasMany(pesticide_apply::class);
    }

    public function disease()
    {
        return $this->hasMany(disease::class);
    }

    public function active_principle()
    {
        return $this->hasMany(active_principle::class);
    }

    public function category_pesticide()
    {
        return $this->hasMany(category_pesticide::class);
    }

    public function bank()
    {
        return $this->hasMany(bank::class);
    }

    public function cashFlow()
    {
        return $this->hasMany(cashFlow::class);
    }

    public function type_product()
    {
        return $this->hasMany(type_product::class);
    }

    public function entry()
    {
        return $this->hasMany(entry::class);
    }

    public function provide()
    {
        return $this->hasMany(provide::class);
    }

    public function fertilizer_inventory()
    {
        return $this->hasMany(fertilizer_inventory::class);
    }

    public function fertilizer_entry()
    {
        return $this->hasMany(fertilizer_entry::class);
    }

    public function pesticide_inventory()
    {
        return $this->hasMany(pesticide_inventory::class);
    }

    public function pesticide_entry()
    {
        return $this->hasMany(pesticide_entry::class);
    }

}
