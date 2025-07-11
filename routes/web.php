<?php

use Illuminate\Support\Facades\Route;

// User
use App\Livewire\Home;
use App\Livewire\Hubungi;
use App\Livewire\Layanan\Index as LayananIndex;
use App\Livewire\Berita\Index as BeritaIndex;
use App\Livewire\Berita\Show as BeritaShow;
use App\Livewire\SkmPage;
use App\Http\Controllers\SkmResultController;

// Admin
// Dashboard
use App\Livewire\Admin\Dashboard\Index as AdminDashboardIndex;

// Produk
use App\Livewire\Admin\Produk\Index as AdminProdukIndex;
use App\Livewire\Admin\Produk\Create as AdminProdukCreate;
use App\Livewire\Admin\Produk\Edit as AdminProdukEdit;
use App\Livewire\Admin\Produk\Show as AdminProdukShow;

// Berita
use App\Livewire\Admin\Berita\Index as AdminBeritaIndex;
use App\Livewire\Admin\Berita\Create as AdminBeritaCreate;
use App\Livewire\Admin\Berita\Edit as AdminBeritaEdit;
use App\Livewire\Admin\Berita\Show as AdminBeritaShow;

// Pengguna
use App\Livewire\Admin\Akun\Index as AdminAkunIndex;
use App\Livewire\Admin\Akun\Edit as AdminAkunEdit;

Route::view('/', 'welcome');

Route::get('/home', Home::class)->name('home');

Route::prefix('/layanan')->name('layanan')->group(function () {
    Route::get('',LayananIndex::class)->name('.index'); 
});

Route::prefix('/berita')->name('berita')->group(function () {
    Route::get('',BeritaIndex::class)->name('.index');
    Route::get('/show/{beritaId}',BeritaShow::class)->name('.show');
});

Route::get('/skm', SkmPage::class)->name('skm.index');

Route::post('/skm/submit-survey', [SkmResultController::class, 'store'])->name('skm.submit_survey');

Route::get('/hubungi', Hubungi::class)->name('hubungi');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::prefix('/admin')->name('admin')->group(function () {
    Route::prefix('/dashboard')->name('.dashboard')->group(function () {
        Route::get('',AdminDashboardIndex::class)->name('.index'); 
    });

    Route::prefix('/produk')->name('.produk')->group(function () {
        Route::get('',AdminProdukIndex::class)->name('.index'); 
        Route::get('/create',AdminProdukCreate::class)->name('.create');
        Route::get('/edit/{produkId}',AdminProdukEdit::class)->name('.edit');
        Route::get('/show/{produkId}',AdminProdukShow::class)->name('.show');
    });

    Route::prefix('/berita')->name('.berita')->group(function () {
        Route::get('',AdminBeritaIndex::class)->name('.index'); 
        Route::get('/create',AdminBeritaCreate::class)->name('.create');
        Route::get('/edit/{beritaId}',AdminBeritaEdit::class)->name('.edit');
        Route::get('/show/{beritaId}',AdminBeritaShow::class)->name('.show');
    });

    Route::prefix('/akun')->name('.akun')->group(function () {
        Route::get('',AdminAkunIndex::class)->name('.index');
        Route::get('/edit/{userId}',AdminAkunEdit::class)->name('.edit');
    });
});

require __DIR__.'/auth.php';