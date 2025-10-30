<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\TypingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API Routes

// Get authenticated user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    // chat messages routes
    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);

    // typing indicator route
    Route::post('/typing', TypingController::class);
});

// Route::post('/typing', TypingController::class)->middleware('auth:sanctum');

// root password: #CA4JU4?&-xWzaS2,'4l    // for vps hosto
// RootPassword@01 // for root user