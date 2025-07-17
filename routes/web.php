<?php

use App\Http\Controllers\AnjunganController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnjunganController::class, 'index'])->name('anjungan');
