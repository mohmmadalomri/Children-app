<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TranslationCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name','deleted_at'];
    protected $hidden=['created_at','updated_at'];

    public function translation(){
        return $this->hasMany(Translation::class,'category-id','id');
    }

}
