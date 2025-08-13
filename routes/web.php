<?php

use App\Http\Controllers\DashBoard;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashBoard::class, 'index']);
    Route::get('/dashboard', [DashBoard::class, 'index'])->name('dashboard');
    Route::post('/store', [DashBoard::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [DashBoard::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/{code}', [DashBoard::class, 'redirect'])
    ->where('code', '[A-Za-z0-9]{6}')
    ->name('redirect');

require __DIR__.'/auth.php';
