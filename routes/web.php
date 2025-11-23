<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Models\Tweet;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Get all tweets ordered by newest first, with user and likes count
    $tweets = Tweet::with('user')
        ->withCount('likes')
        ->latest()
        ->get();
    
    return view('welcome', ['tweets' => $tweets, 'activeTab' => 'home']);
})->name('home');

// My Tweets route
Route::get('/my-tweets', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    // Get only the authenticated user's tweets
    $tweets = Tweet::with('user')
        ->withCount('likes')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();
    
    return view('welcome', ['tweets' => $tweets, 'activeTab' => 'my-tweets']);
})->name('my-tweets');

// Tweet routes (all require authentication)
Route::middleware(['auth'])->group(function () {
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
    Route::put('/tweets/{tweet}', [TweetController::class, 'update'])->name('tweets.update');
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->name('tweets.destroy');
    Route::post('/tweets/{tweet}/like', [TweetController::class, 'toggleLike'])->name('tweets.toggleLike');
});

// Profile route
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/about-me', [ProfileController::class, 'updateAboutMe'])->name('profile.updateAboutMe');
});

require __DIR__.'/auth.php';
