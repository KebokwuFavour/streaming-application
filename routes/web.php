<?php

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

Route::get('/tickets', function () {
    return Inertia::render('Tickets');
})->name('tickets');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/streams', function () {
        // get the authenticated user
        $user = Auth::user();

        // if ($user->hasActiveTicket()) {
            // return redirect(route('streams'));
            return Inertia::render('Streams');
        // }

        // return redirect(route('tickets'));
        
    })->name('streams');

    // Route for verifying ticket payments
    Route::post('/tickets/verify', [TicketController::class, 'verify']);

    // Route for the talks page
    Route::post('/talks', function() {
        return Inertia::render('Talks');
    });

    // Route for the video player page
    Route::get('/video-player', function () {
        return Inertia::render('VideoPlayer');
    })->name('video-player');
});