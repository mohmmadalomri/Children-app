<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoiceCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $fillable=['name'];
    protected $hidden=['created_at','updated_at'];

    public function voices(){
        return $this->hasMany(Voice::class,'category_id','id');
    }
}
