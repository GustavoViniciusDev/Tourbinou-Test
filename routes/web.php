<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\Ride;
use Inertia\Inertia;

Route::fallback(function () {
    return Inertia::render('404NotFound');
});

Route::get('/store', function () {
    return Inertia::render('Store', [
        'rides' => Ride::with('destination:id,cidade,estado')->get(),
    ]);
})->name('store');

Route::get('/', function () {
    return redirect()->route('store');
});

Route::middleware('auth')->group(function () {
    Route::get('/login', function () {
        return redirect()->route('ride.index');
    });

    Route::get('/register', function () {
        return redirect()->route('ride.index');
    });



    Route::get('/destination', [DestinationController::class, 'index'])->name('destination.index');
    Route::get('/register_destination', [DestinationController::class, 'create'])->name('register_destination');
    Route::post('/register_destination', [DestinationController::class, 'store'])->name('destination.store');
    Route::get('/destination/{id}/edit', [DestinationController::class, 'edit'])->name('destination.edit');
    Route::post('/destination/{id}', [DestinationController::class, 'update'])->name('destination.update');
    Route::delete('/destination/{id}', [DestinationController::class, 'destroy'])->name('destination.destroy');

    Route::get('/ride', [RideController::class, 'index'])->name('ride.index');
    Route::get('/register_ride', [RideController::class, 'create'])->name('register_ride');
    Route::post('/register_ride', [RideController::class, 'store'])->name('ride.store');
    Route::get('/ride/{id}/edit', [RideController::class, 'edit'])->name('ride.edit');
    Route::post('/ride/{id}', [RideController::class, 'update'])->name('ride.update');
    Route::delete('/ride/{id}', [RideController::class, 'destroy'])->name('ride.destroy');
});

require __DIR__.'/auth.php';
