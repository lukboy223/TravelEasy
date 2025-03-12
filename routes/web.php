<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});

// Trip routes
Route::get('/trips', [TripController::class, 'index'])->name('trips.index');

// Invoice routes
// Create a new invoice
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
// Zorg ervoor dat de route een parameter verwacht (bookingId)
//Route::get('/invoices/create/{bookingId}', [InvoiceController::class, 'create'])->name('invoices.create');

Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
