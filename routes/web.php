<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome-page');

Route::get('/suggest', function () {
    return Inertia::render('Suggest');
})->name('suggest');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // // tickets route
    // Route::get('/tickets', function () {
    //     return Inertia::render('Tickets');
    // })->name('tickets');

    // streams route
    Route::get('/streams', function () {
        return Inertia::render('Streams');
    })->name('streams');

    // Route for verifying ticket payments
    Route::post('/tickets/verify', [TicketController::class, 'verify']);

    // Route for the talks/conversation page
    Route::get('/talks', function() {
        return Inertia::render('Talks');
    })->name('talks');

    // Route for the video player page
    Route::get('/video/play', function () {
        return Inertia::render('VideoPlayer');
    })->name('video-player');
});