<?php

use App\Http\Controllers\Admin\{ReplySupportController, SupportController}; // com "{}" outros podem usar essa mesma importação
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

// Route::get('/contato', function(){
//     return view('site/contact');
// });

//get(URL, "ação => chama a função contact la da classe SiteController")
Route::get('/contato', [SiteController::class, 'contact']);

Route::get('/', function () {
    return view('welcome'); //retorna a welcome.blade.php
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/supports/create', [SupportController::class, 'create'])->name('supports.create');

    Route::post('/supports/{id}/replies', [ReplySupportController::class, 'store'])->name('replies.store');
    Route::delete('/supports/{id}/replies/{reply}', [ReplySupportController::class, 'destroy'])->name('replies.destroy');
    Route::get('/supports/{id}/replies', [ReplySupportController::class, 'index'])->name('replies.index');

    // Route::resource('/supports', SupportController::class);
    Route::delete('/supports/{id}', [SupportController::class, 'show'])->name('supports.show');
    Route::delete('/supports/{id}', [SupportController::class, 'destroy'])->name('supports.destroy');
    Route::put('/supports/{id}', [SupportController::class, 'update'])->name('supports.update');
    Route::get('/supports/{id}/edit', [SupportController::class, 'edit'])->name('supports.edit'); //name('supports.edit') => nome da rota / função chamada
    Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');
    Route::get('/supports', [SupportController::class, 'index'])->name('supports.index'); //ForumController = SupportController,
    //name('supports.index') => para n precisar utiliar a URL (forum) quando for chamada
});

require __DIR__ . '/auth.php';
