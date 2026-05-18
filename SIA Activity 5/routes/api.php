<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

// Requirement Part 3: Internal API Output
Route::get('/users', function () {
    return response()->json(User::all());
});

// Bonus: API Authentication using Sanctum
Route::middleware('auth:sanctum')->get('/user-secure', function (Request $request) {
    return $request->user();
});