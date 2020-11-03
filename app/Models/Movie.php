<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function genres(){
        return $this->hasMany(GenreMovie::class, 'movie_id', 'id');
    }
    
    public function directors(){
        return $this->hasMany(Director::class, 'movie_id', 'id');
    }

    public function actors(){
        return $this->hasMany(Actor::class, 'movie_id', 'id');
    }
}
