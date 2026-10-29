<?php

use App\Http\Controllers\LeverancierController;
use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/magazijn', [MagazijnController::class, 'index'])
    ->middleware(['auth', 'role:beheerder,magazijnmedewerker'])
    ->name('magazijn.index');

Route::middleware(['auth', 'role:beheerder,magazijnmedewerker'])->group(function () {
    Route::get('/leveranciers', [LeverancierController::class, 'index'])
        ->name('leveranciers.index');
    Route::get('/leveranciers/{leverancierId}/producten', [LeverancierController::class, 'producten'])
        ->name('leveranciers.producten');
    Route::get('/leveranciers/{leverancierId}/producten/{productId}/levering', [LeverancierController::class, 'createLevering'])
        ->name('leveranciers.levering.create');
    Route::post('/leveranciers/{leverancierId}/producten/{productId}/levering', [LeverancierController::class, 'storeLevering'])
        ->name('leveranciers.levering.store');
});

Route::get('/leverantie/{productId}', [MagazijnController::class, 'leverantie'])
    ->middleware(['auth', 'role:beheerder,magazijnmedewerker'])
    ->name('leverantie.show');

Route::get('/allergenen/{productId}', [MagazijnController::class, 'allergenen'])
    ->middleware(['auth', 'role:beheerder,magazijnmedewerker'])
    ->name('allergenen.show');

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserRoleController::class, 'index'])
        ->middleware('role:beheerder')
        ->name('users.index');
    Route::patch('/users/{user}/role', [UserRoleController::class, 'update'])
        ->middleware('role:beheerder')
        ->name('users.role.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
