<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

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

route::middleware('auth')->group(function () {
    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('/message/create', [MessageController::class, 'create'])->name('message.create');
    Route::post('/message/store', [MessageController::class, 'store'])->name('message.store');
    Route::get('/message/send{id}', [MessageController::class, 'send'])->name('message.send');
    Route::get('/message/{bericht}', [MessageController::class, 'show']);
    Route::get('/message/{bericht}/edit', [MessageController::class, 'edit'])->name('message.edit');
    Route::patch('/message/{bericht}', [MessageController::class, 'update']);
    Route::delete('/message/{bericht}', [MessageController::class, 'destroy'])->name('message.destroy');
});



require __DIR__ . '/auth.php';
