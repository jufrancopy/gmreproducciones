<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $dates    = ['deleted_at'];
    protected $table   = 'orders';
    protected $hidden   =  ['created_at','updated_at'];

    public function getItems(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
