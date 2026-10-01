<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MicrosoftAuthController;
use App\Http\Controllers\DashboardController;

// Default Landing Page
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    // Standard Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Microsoft OAuth
    Route::get('/auth/microsoft', [MicrosoftAuthController::class, 'redirect'])->name('auth.microsoft');
    Route::get('/auth/microsoft/callback', [MicrosoftAuthController::class, 'callback']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard & Tasks
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/tasks', [DashboardController::class, 'storeTask'])->name('tasks.store');
    Route::patch('/tasks/{task}/toggle', [DashboardController::class, 'toggleTask'])->name('tasks.toggle');
    Route::delete('/tasks/{task}', [DashboardController::class, 'destroyTask'])->name('tasks.destroy');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});