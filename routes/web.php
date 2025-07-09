<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Hubungi;
use App\Livewire\Layanan\Index as LayananIndex;

// Admin
use App\Livewire\Admin\Dashboard\Index as DashboardIndex;

Route::view('/', 'welcome');

Route::get('/home', Home::class)->name('home');

Route::prefix('/admin')->name('admin')->group(function () {
    Route::prefix('/dashboard')->name('dashboard')->group(function () {
        Route::get('',DashboardIndex::class)->name('.index'); 
    });
});

Route::prefix('/layanan')->name('layanan')->group(function () {
    Route::get('',LayananIndex::class)->name('.index'); 
});

Route::get('/hubungi', Hubungi::class)->name('hubungi');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';