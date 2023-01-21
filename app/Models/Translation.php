<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable=['name','link','image','category-id'];

    public function category(){
        return $this->belongsTo(TranslationCategory::class,'category-id','id');
    }
}
