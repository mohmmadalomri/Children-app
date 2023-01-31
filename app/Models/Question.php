<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable=['name','category_id','link','image'];

    public function category(){
        return $this->belongsTo(CategoryOfGames::class,'category_id','id');
    }
}
