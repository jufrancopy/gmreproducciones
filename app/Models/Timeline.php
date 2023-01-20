<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Timeline extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates    = ['deleted_at'];
    protected $table   = 'timelines';
    protected $hidden   =  ['created_at','updated_at'];
    
    public function getGallery(){
        return $this->hasMany(Gallery::class, 'timeline_id','id');
    }

    public function profile(){
        return $this->hasOne(TimelineProfile::class, 'id', 'profile_id');
    }
}
