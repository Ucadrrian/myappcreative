<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comics extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates=['deleted_at'];
    protected $table='comics';
    protected $hidden=['created_at','updated_at'];

    public function cat(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function getGallery(){
        return $this->hasMany(CGallery::class,'comic_id','id',);
    }
}
