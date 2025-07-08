<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;

Route::view('/', 'welcome');

Route::get('/home', Home::class)->name('home');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';