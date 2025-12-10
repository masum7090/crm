<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\DomainSearchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return view('market_place.home');
});
Route::post('/check-domain', [DomainSearchController::class, 'check'])->name('check.domain');
Route::get('/plans', function () {
    $domain = request()->get('domain');
    return view('market_place.partials.plans', compact('domain'));
})->name('plans');

Route::get('/checkout-page', function () {
    return view('market_place.partials.checkout-page');
})->name('checkout-page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
