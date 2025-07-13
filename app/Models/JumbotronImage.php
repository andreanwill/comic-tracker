<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JumbotronImage extends Model
{
    protected $table = 'andrean_jumbotron_images';
    protected $fillable = ['image_path', 'order'];
}
