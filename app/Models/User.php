<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAddress(){
        return $this->hasMany(UserAddress::class, 'user_id', 'id')->with(['getState', 'getCity']);
    }

    public function getAddressDefault(){
        return $this->hasOne(UserAddress::class,'user_id', 'id')->where('default', 1)->with(['getState', 'getCity']);
    }

    public function getOrders(){
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function getOrdersProcess(){
        return $this->hasMany(Order::class, 'user_id', 'id')->whereNot('status', '!=',0);
    }
}
