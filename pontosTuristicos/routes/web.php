<?php

use App\Http\Controllers\Admin\{SupportController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\{SiteController};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contato', [SiteController::class, 'contact']);

Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');
Route::get('/supports/create', [SupportController::class, 'create'])->name('supports.create');
Route::get('/supports', [SupportController::class, 'index'])->name('supports.index');

Route::get('/explorers/show', [SiteController::class, 'show'])->name('explorers.show');
Route::get('/explorers', [SiteController::class, 'explorers'])->name('explorers');
