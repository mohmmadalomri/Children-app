<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryOfGames extends Model
{
    use SoftDeletes;

    use HasFactory;
    protected $fillable=['name'];
    protected $hidden=['created_at','updated_at'];

    public function games(){
        return $this->hasMany(Game::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }
}
