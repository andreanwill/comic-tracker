<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    protected $table = 'andrean_comics';

    protected $fillable = ['title', 'description', 'cover_image'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'andrean_comic_genres', 'comic_id', 'genre_id');
    }

    public function readStatuses()
    {
        return $this->hasMany(ReadStatus::class, 'comic_id');
    }
}
