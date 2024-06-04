<?php

use App\Http\Controllers\EmailAutomation;
use App\Http\Controllers\PublishAutomation;
use App\Http\Controllers\SocialAutomation;
use App\Http\Controllers\GithubAutomation;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::post('/api/extract', SocialAutomation::class)
    ->middleware('guest')
    ->name('extract');

Route::post('/api/github', GithubAutomation::class)
    ->middleware('guest')
    ->name('github');

Route::post('/api/email', EmailAutomation::class)
    ->middleware('guest')
    ->name('email');

Route::post('/api/publish', PublishAutomation::class)
    ->middleware('guest')
    ->name('publish');
Route::post('/api/publish', PublishAutomation::class)
    ->middleware('guest')
    ->name('publish');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
