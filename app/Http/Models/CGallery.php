<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CGallery extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates=['deleted_at'];
    protected $table='comics_gallery';
    protected $hidden=['created_at','updated_at'];

}
