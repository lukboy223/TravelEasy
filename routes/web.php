<?php

use App\Http\Controllers\ManagementController;
use Illuminate\Support\Facades\Route;

// controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// custom middleware
use App\Http\Middleware\checkEmployee;
use App\Http\Middleware\checkAdmin;

Route::get('/', function () {
    return view('homepagina/Home');
})->name('home');
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


Route::middleware(['auth', checkAdmin::class])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
});

Route::middleware(['auth', checkAdmin::class])->group(function () {
   Route::get('/bookingPeriod', [ManagementController::class, 'BookingPeriod'])->name('management.Booking');
});

require __DIR__.'/auth.php';
