<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GallerySlideshowController;
use App\Http\Controllers\IdentityController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StructureController;
use Illuminate\Support\Facades\Route;

// Route for auth
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('/', AuthController::class)->middleware('guest');

// Route for Keuangan
Route::resource('/keuangan', KeuanganController::class);
Route::get('file-export', [KeuanganController::class, 'fileExport'])->name('file-export');
Route::get('export-pdf', [KeuanganController::class, 'createPDF'])->name('export-pdf');



// Route for Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Route for Actifity
Route::resource('/activity', ActivityController::class);

// Route for Identity
Route::resource('/identity', IdentityController::class);

// Route for Structure organisasai
Route::resource('/structure', StructureController::class);

// Route for Gallery
Route::resource('/gallery', GalleryController::class);

// Route for Identity
Route::resource('/gallery_slideshow', GallerySlideshowController::class);

// Route for Profile
Route::resource('/profile', ProfileController::class);
