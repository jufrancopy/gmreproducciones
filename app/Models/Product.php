<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates    = ['deleted_at'];
    protected $table   = 'products';
    protected $hidden   =  ['created_at','updated_at'];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function subCategory(){
        return $this->hasOne(Category::class, 'id', 'subCategory_id');
    }

    public function getGallery(){
        return $this->hasMany(PGallery::class, 'product_id','id');
    }

    public function getInventory(){
        return $this->hasMany(Inventory::class, 'product_id', 'id')->orderBy('price', 'ASC');
    }

    public function getPrice(){
        return $this->hasMany(Inventory::class, 'product_id', 'id');
    }
}
