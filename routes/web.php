<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\EstadisticasController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/principal', [PrincipalController::class, 'index'])->middleware('auth');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::post('/attributes/assign', [DashboardController::class, 'assignAttribute'])
        ->name('attributes.assign');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas');

    Route::get('/tienda', [ShopController::class, 'index'])->name('tienda');
    Route::post('/tienda/comprar/{item}', [ShopController::class, 'comprar'])->name('shop.comprar');

    // Redirigir /dashboard a /principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
