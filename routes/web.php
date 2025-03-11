<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerichtController;

Route::get('/', function () {
    return view('homepagina/Home');
});
Route::get('/homefail', function () {
    return view('homepagina/unhappyhome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
});

Route::get('/message', [BerichtController::class, 'index'])->name('message.index');
Route::get('/message/create', [BerichtController::class, 'create']);
Route::post('/message/store', [BerichtController::class, 'store']);
Route::get('/message/{bericht}', [BerichtController::class, 'show']);
Route::get('/message/{bericht}/edit', [BerichtController::class, 'edit']);
Route::patch('/message/{bericht}', [BerichtController::class, 'update']);
Route::delete('/message/{bericht}', [BerichtController::class, 'destroy']);



require __DIR__.'/auth.php';
