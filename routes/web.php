<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ProfileController;
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
});

Route::get('/ride', function () {
    return Inertia::render('Ride');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->middleware('guest')->name('login');

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
})->middleware('guest')->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/login', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/register', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/destination', function () {
        return Inertia::render('Destination');
    })->name('destination');

    Route::get('/register_destination', [DestinationController::class, 'create'])->name('register_destination');
    Route::post('/register_destination', [DestinationController::class, 'store'])->name('destination.store');
});

Route::fallback(function () {
    return Inertia::render('404NotFound');
});

require __DIR__.'/auth.php';
