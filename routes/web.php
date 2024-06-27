<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/search', [\App\Http\Controllers\HomeController::class, 'search'])->name('search');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('post/{post}', [\App\Http\Controllers\ShowPostController::class, 'show'])->name('post');



Route::middleware('auth')->group(function () {
  // dislike and like routes
  Route::post('heart/{post}', [\App\Http\Controllers\HeartPostController::class, 'heart'])->name('heart');

  Route::get('/dashboard', function () {
      return view('dashboard');
  })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('is_admin')->group(function () {
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('posts', \App\Http\Controllers\PostController::class);
});

require __DIR__.'/auth.php';
