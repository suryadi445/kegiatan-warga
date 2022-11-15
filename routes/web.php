<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeuanganController;
use Illuminate\Support\Facades\Route;

// Route for auth
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('/', AuthController::class);

// Route for Keuangan
Route::resource('/keuangan', KeuanganController::class);

// Route for Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Route for Actifity
Route::resource('/activity', ActivityController::class);
