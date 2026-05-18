<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;

// Change this line in routes/web.php
Route::get('/', function () {
    return view('auth.login');
});

// Standard Dashboard (Accessible by both User and Admin)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin Dashboard (Protected by 'admin' middleware)
// Only users with role 'Admin' can access this
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin']) 
    ->name('admin.dashboard');

    // 1. Route to show the Reset Password Page
Route::get('/reset-password', [NewPasswordController::class, 'createDirect'])
    ->name('password.direct');

// 2. Route to handle the form submission logic
Route::post('/reset-password', [NewPasswordController::class, 'storeDirect'])
    ->name('password.update.direct');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';