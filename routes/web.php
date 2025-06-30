<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Comic;

Route::get('/', function () {
    $comics = \App\Models\Comic::with('genres')->limit(4)->get();
    return view('welcome', compact('comics'));
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/register', [AuthController::class, 'registerForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/comics', function () {
    $comics = \App\Models\Comic::with('genres')->get();
    return view('comics.index', compact('comics'));
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
    // CRUD Komik
    Route::resource('/admin/comics', \App\Http\Controllers\ComicController::class);

    // CRUD Genre
    Route::resource('/admin/genres', \App\Http\Controllers\GenreController::class);
});

