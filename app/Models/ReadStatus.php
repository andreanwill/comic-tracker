<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadStatus extends Model
{
    protected $table = 'andrean_read_statuses';

    protected $fillable = ['user_id', 'comic_id', 'status'];

    public function comic()
    {
        return $this->belongsTo(Comic::class, 'comic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
