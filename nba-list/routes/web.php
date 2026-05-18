<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

// Redirect root to items list
Route::get('/', function () {
    return redirect('/items');
});

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');