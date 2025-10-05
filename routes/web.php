<?php

use App\Http\Controllers\TicketController;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Application;
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
        $user = auth()->user();

        // // Ensure the user has a ticket
        // $user->tickets()->updateOrCreate(
        //     [], // no condition → always update/create their ticket
        //     ['expires_at' => now()->addMinutes(5)]
        // );

        if ($user->hasActiveTicket()) {
            // return redirect(route('streams'));
            return Inertia::render('Streams');
        }

        
        return redirect(route('tickets'));
        // return Inertia::render('Tickets');
    })->name('streams');
    // Route::get('/tickets', function () {
    //     // return Inertia::render('Dashboard');
    //     return Inertia::render('Tickets');
    // })->name('tickets');

    Route::post('/tickets/verify', [TicketController::class, 'verify']);
    Route::get('/video-player', function () {
        return Inertia::render('VideoPlayer');
    })->name('video-player');
});