<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'andrean_genres';

    protected $fillable = ['name'];

    public function comics()
    {
        return $this->belongsToMany(Comic::class, 'andrean_comic_genres', 'genre_id', 'comic_id');
    }
}
