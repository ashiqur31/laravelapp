<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\FileController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard')->middleware('auth');
Route::post('/file-preview', [DashboardController::class, 'previewFile'])->name('file.preview')->middleware('auth');
Route::get('/cancel_upload', [DashboardController::class, 'cancel'])->name('file.cancel')->middleware('auth');
Route::post('/upload-file', [DashboardController::class,'uploadFile'])->name('file.upload');
Route::get('/download-file/{id}', [DashboardController::class, 'downloadFile'])->name('download_file');

Route::get('/profile', [ProfileController::class,'viewProfile'])->name('profile');

// routes/api.php


Route::middleware('auth:api')->group(function () {
    Route::get('/files/{file}/data', [FileController::class, 'getData']);
});
