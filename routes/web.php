<?php

use App\Http\Controllers\AnjunganController;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Middleware\SuratAuth;

// use App\Http\Controllers\Api\ConfigController;

Route::get('/', [AnjunganController::class, 'index'])->name('anjungan');

Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(SuratAuth::class)->group(function () {
    Route::get('/surat', [SuratController::class, 'index']);
});

