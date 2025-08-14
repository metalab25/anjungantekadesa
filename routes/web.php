<?php

use App\Http\Controllers\AnjunganController;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\SuratApiController;
use App\Http\Controllers\Api\PendudukController;
use App\Http\Controllers\Api\PamongController;
use App\Http\Controllers\LayananMandiriController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Middleware\SuratAuthMiddleware;

// use App\Http\Controllers\Api\ConfigController;

Route::get('/', [AnjunganController::class, 'index'])->name('anjungan');

Route::get('/login/nik', [LoginController::class, 'loginNik'])->name('login.nik');
Route::get('/login/ktp', [LoginController::class, 'loginKtp'])->name('login.ktp');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
Route::post('/auth-ktp', [LoginController::class, 'auth_ktp'])->name('login.auth_ktp');

Route::post('/update-id-ktp/{penduduk_id}', [\App\Http\Controllers\PendudukMandiriController::class, 'updateIdKtp'])->name('penduduk_mandiri.update_id_ktp');

Route::middleware(SuratAuthMiddleware::class)->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/surat', [LayananMandiriController::class, 'listSurat'])->name('surat.index');
    Route::get('/arsip-surat', [SuratController::class, 'arsipSurat'])->name('surat.arsip.surat');
    Route::get('/surat/{url_surat}', [LayananMandiriController::class, 'detailSurat'])->name('layanan.surat.detail');
    Route::post('/surat/{url_surat}/ajukan', [LayananMandiriController::class, 'ajukanSurat'])->name('layanan.surat.ajukan');
    Route::get('/preview/surat/{id}', [LayananMandiriController::class, 'previewSurat'])->name('layanan.surat.preview');

    Route::get('/arsip', [LayananMandiriController::class, 'arsipSurat'])->name('layanan.arsip');
    Route::get('/arsip/{id}/download', [LayananMandiriController::class, 'downloadSurat'])->name('layanan.arsip.download');
});

// API Routes for Confi
