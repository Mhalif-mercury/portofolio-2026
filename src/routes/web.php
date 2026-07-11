<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PortofolioController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/

Route::get('/', [PortofolioController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/{slug}', [PortofolioController::class, 'show'])
    ->name('blog.show');

Route::post('/contact', [ContactMessageController::class, 'store'])
    ->name('contact.store');
