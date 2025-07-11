<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Comic;
use App\Http\Controllers\Controller;
use App\Models\JumbotronImage;

Route::get('/', function () {
    $comics = \App\Models\Comic::with('genres')->limit(4)->get();
    $jumbotronImages = Controller::getJumbotronImages();
    return view('welcome', compact('comics', 'jumbotronImages'));
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/register', [AuthController::class, 'registerForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/comics', [\App\Http\Controllers\ComicController::class, 'publicIndex'])->name('comics.index');
Route::get('/komik/{comic}', [\App\Http\Controllers\ComicController::class, 'show'])->name('comics.show');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    // CRUD Komik
    Route::resource('comics', \App\Http\Controllers\ComicController::class);
    // CRUD Genre
    Route::resource('genres', \App\Http\Controllers\GenreController::class);
    // CRUD Jumbotron Images
    Route::resource('jumbotron', \App\Http\Controllers\Admin\JumbotronImageController::class)->except(['show', 'edit', 'update', 'create']);
    Route::post('jumbotron/update-order', [\App\Http\Controllers\Admin\JumbotronImageController::class, 'updateOrder'])->name('jumbotron.updateOrder');
});

