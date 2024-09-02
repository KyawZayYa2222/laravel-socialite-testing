<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/home', 301);

// Email login
Auth::routes();

// Google Login
Route::controller(App\Http\Controllers\Auth\GoogleLoginController::class)->group(function() {
    Route::get('/google/redirect', 'redirectToGoogle')->name('google-redirect');
    Route::get('/google/callback', 'handleGoogleCallback')->name('google-callback');
});

// Github Login
Route::controller(App\Http\Controllers\Auth\GithubLoginController::class)->group(function() {
    Route::get('/github/redirect', 'redirectToGithub')->name('github-redirect');
    Route::get('/github/callback', 'callbackToGithub')->name('github-callback');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
