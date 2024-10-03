<?php

use App\Http\Controllers\Admin\{SupportController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\{SiteController};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contato', [SiteController::class, 'contact']);

Route::put('/supports/{id}', [SupportController::class, 'update'])->name('supports.update');
Route::get('/supports/{id}/edit', [SupportController::class, 'edit'])->name('supports.edit');
Route::get('/supports/create', [SupportController::class, 'create'])->name('supports.create');
Route::get('/supports/{id}', [SupportController::class, 'show'])->name('supports.show'); //PARAMETROS DINAMICOS SEMPRE VEM DEPOIS DOS ESTÁSTICOS
Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');
Route::get('/supports', [SupportController::class, 'index'])->name('supports.index');

Route::put('/explorers/{id}', [SiteController::class, 'update'])->name('explorers.update');
Route::get('/explorers/{id}/edit', [SiteController::class, 'edit'])->name('explorers.edit');
Route::get('/explorers/create', [SiteController::class, 'create'])->name('explorers.create');
Route::get('/explorers/{id}', [SiteController::class, 'details'])->name('explorers.details');
Route::post('/explorers', [SiteController::class, 'store'])->name('explorers.store');
Route::get('/explorers', [SiteController::class, 'show'])->name('explorers.show');

// Route::get('/explorers/show', [SiteController::class, 'show'])->name('explorers.show');
// Route::get('/explorers', [SiteController::class, 'explorers'])->name('explorers');
