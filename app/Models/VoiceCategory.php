<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceCategory extends Model
{
    use HasFactory;
    protected  $fillable=['name'];

    public function voices(){
        return $this->hasMany(Voice::class,'voicecategory','id');
    }
}
