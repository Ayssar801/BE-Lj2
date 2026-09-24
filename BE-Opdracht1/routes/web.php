<?php

use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/magazijn', [MagazijnController::class, 'index'])
    ->middleware('auth')
    ->name('magazijn.index');

    Route::get('/leverantie/{productId}', [MagazijnController::class, 'leverantie'])
        ->middleware('auth')
        ->name('leverantie.show');

Route::get('/allergenen/{productId}', [MagazijnController::class, 'allergenen'])
    ->middleware('auth')
    ->name('allergenen.show');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
