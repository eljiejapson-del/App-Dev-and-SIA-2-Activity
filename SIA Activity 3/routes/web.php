<?php

use Illuminate\Support\Facades\Route;
// Import your controller
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Redirect the root URL to the games index
Route::get('/', function () {
    return redirect()->route('games.index');
});

// 2. Register all 7 CRUD routes (index, create, store, show, edit, update, destroy)
Route::resource('games', GameController::class);