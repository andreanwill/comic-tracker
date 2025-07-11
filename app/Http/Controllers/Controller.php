<?php

namespace App\Http\Controllers;

use App\Models\JumbotronImage;

abstract class Controller
{
    //

    public static function getJumbotronImages()
    {
        return JumbotronImage::orderBy('order')->limit(5)->get();
    }
}
