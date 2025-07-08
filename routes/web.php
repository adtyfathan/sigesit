<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Hubungi;
use App\Livewire\Layanan\Index as LayananIndex;

Route::view('/', 'welcome');

Route::get('/home', Home::class)->name('home');

Route::prefix('/layanan')->name('layanan')->group(function () {
    Route::get('',LayananIndex::class)->name('.index'); 
});

Route::get('/hubungi', Hubungi::class)->name('hubungi');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';