<?php

use App\Http\Controllers\ConfessionController;
use Illuminate\Support\Facades\Route;

Route::get('/confess', [ConfessionController::class, 'index']);
Route::post('/confess', [ConfessionController::class, 'store']);