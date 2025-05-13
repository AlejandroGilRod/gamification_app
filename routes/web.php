<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/principal', function () {
    return view('principal');
})->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Redirigir /dashboard a /principal
    Route::get('/dashboard', function () {
        return redirect('/principal');
    })->name('dashboard');
});
