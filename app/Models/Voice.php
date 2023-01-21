<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voice extends Model
{
    use HasFactory;
    protected $fillable=['voice_file','voicecategory','name'];
    public function voicecategory(){
        return $this->belongsTo(VoiceCategory::class,'id','voicecategory');

    }
}
