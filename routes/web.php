<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SktmController;
use App\Http\Controllers\SkdController;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\SkpController;
use App\Http\Controllers\SkmtController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\PengajuanDokumenController;

Route::get('/', [MasyarakatController::class, 'index'])->name('beranda');
Route::get('/form-pengajuan', [MasyarakatController::class, 'form'])->name('pengajuan');
Route::post('/form-pengajuan', [MasyarakatController::class, 'submitForm'])->name('pengajuan.submit');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::get('/forgot-password', [AdminAuthController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('/forgot-password', [AdminAuthController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [AdminAuthController::class, 'showResetPasswordForm'])
        ->name('password.reset');
    Route::post('/reset-password', [AdminAuthController::class, 'resetPassword'])
        ->name('password.update');

    Route::middleware('auth:admin')->group(function () {

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::middleware('role:admin')->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // ================= SKTM =================
            Route::prefix('sktm')->name('sktm.')->group(function () {
                Route::get('/', [SktmController::class, 'index'])->name('index');
                Route::get('/success/{file}', [SktmController::class, 'success'])->name('success');
                Route::get('/download/{file}', [SktmController::class, 'download'])->name('download');
                Route::get('/{id}', [SktmController::class, 'detail'])->name('detail');
                Route::put('/{id}', [SktmController::class, 'update'])->name('update');
                Route::post('/{id}/verify', [SktmController::class, 'verify'])->name('verify');
                Route::put('/{id}/reject', [SktmController::class, 'reject'])->name('reject');
                Route::post('/{id}/send-notification', [SktmController::class, 'sendNotification'])->name('send-notification');
                Route::post('/{id}/upload-ttd', [SktmController::class, 'uploadTtd'])->name('upload-ttd');
                Route::get('/{id}/download-ttd', [SktmController::class, 'downloadTtd'])->name('download-ttd');
                Route::get('/{id}/print', [SktmController::class, 'print'])->name('print');
            });

            // ================= SKD =================
            Route::prefix('skd')->name('skd.')->group(function () {
                Route::get('/', [SkdController::class, 'index'])->name('index');
                Route::get('/success/{file}', [SkdController::class, 'success'])->name('success');
                Route::get('/download/{file}', [SkdController::class, 'download'])->name('download');
                Route::get('/{id}', [SkdController::class, 'detail'])->name('detail');
                Route::put('/{id}', [SkdController::class, 'update'])->name('update');
                Route::post('/{id}/verify', [SkdController::class, 'verify'])->name('verify');
                Route::put('/{id}/reject', [SkdController::class, 'reject'])->name('reject');
                Route::post('/{id}/send-notification', [SkdController::class, 'sendNotification'])->name('send-notification');
                Route::post('/{id}/upload-ttd', [SkdController::class, 'uploadTtd'])->name('upload-ttd');
                Route::get('/{id}/download-ttd', [SkdController::class, 'downloadTtd'])->name('download-ttd');
                Route::get('/{id}/print', [SkdController::class, 'print'])->name('print');
            });

            // ================= SKU =================
            Route::prefix('sku')->name('sku.')->group(function () {
                Route::get('/', [SkuController::class, 'index'])->name('index');
                Route::get('/success/{file}', [SkuController::class, 'success'])->name('success');
                Route::get('/download/{file}', [SkuController::class, 'download'])->name('download');
                Route::get('/{id}', [SkuController::class, 'detail'])->name('detail');
                Route::put('/{id}', [SkuController::class, 'update'])->name('update');
                Route::post('/{id}/verify', [SkuController::class, 'verify'])->name('verify');
                Route::put('/{id}/reject', [SkuController::class, 'reject'])->name('reject');
                Route::post('/{id}/send-notification', [SkuController::class, 'sendNotification'])->name('send-notification');
                Route::post('/{id}/upload-ttd', [SkuController::class, 'uploadTtd'])->name('upload-ttd');
                Route::get('/{id}/download-ttd', [SkuController::class, 'downloadTtd'])->name('download-ttd');
                Route::get('/{id}/print', [SkuController::class, 'print'])->name('print');
            });

            // ================= SKP =================
            Route::prefix('skp')->name('skp.')->group(function () {
                Route::get('/', [SkpController::class, 'index'])->name('index');
                Route::get('/success/{file}', [SkpController::class, 'success'])->name('success');
                Route::get('/download/{file}', [SkpController::class, 'download'])->name('download');
                Route::get('/{id}', [SkpController::class, 'detail'])->name('detail');
                Route::put('/{id}', [SkpController::class, 'update'])->name('update');
                Route::post('/{id}/verify', [SkpController::class, 'verify'])->name('verify');
                Route::put('/{id}/reject', [SkpController::class, 'reject'])->name('reject');
                Route::post('/{id}/send-notification', [SkpController::class, 'sendNotification'])->name('send-notification');
                Route::post('/{id}/upload-ttd', [SkpController::class, 'uploadTtd'])->name('upload-ttd');
                Route::get('/{id}/download-ttd', [SkpController::class, 'downloadTtd'])->name('download-ttd');
                Route::get('/{id}/print', [SkpController::class, 'print'])->name('print');
            });

            // ================= SKMT =================
            Route::prefix('skmt')->name('skmt.')->group(function () {
                Route::get('/', [SkmtController::class, 'index'])->name('index');
                Route::get('/success/{file}', [SkmtController::class, 'success'])->name('success');
                Route::get('/download/{file}', [SkmtController::class, 'download'])->name('download');
                Route::get('/{id}', [SkmtController::class, 'detail'])->name('detail');
                Route::put('/{id}', [SkmtController::class, 'update'])->name('update');
                Route::post('/{id}/verify', [SkmtController::class, 'verify'])->name('verify');
                Route::put('/{id}/reject', [SkmtController::class, 'reject'])->name('reject');
                Route::post('/{id}/send-notification', [SkmtController::class, 'sendNotification'])->name('send-notification');
                Route::post('/{id}/upload-ttd', [SkmtController::class, 'uploadTtd'])->name('upload-ttd');
                Route::get('/{id}/download-ttd', [SkmtController::class, 'downloadTtd'])->name('download-ttd');
                Route::get('/{id}/print', [SkmtController::class, 'print'])->name('print');
            });

            // Dokumen Pengajuan
            Route::get('/pengajuan/{pengajuan}/dokumen/view', [PengajuanDokumenController::class, 'view'])
                ->name('pengajuan.dokumen.view');

            Route::get('/pengajuan/{pengajuan}/dokumen/download', [PengajuanDokumenController::class, 'download'])
                ->name('pengajuan.dokumen.download');
        });

        Route::middleware('role:admin,kades')
            ->prefix('arsip')
            ->name('arsip.')
            ->group(function () {

                Route::get('/', [ArsipSuratController::class, 'index'])->name('index');
                Route::get('/{id}', [ArsipSuratController::class, 'show'])->name('show');
                Route::get('/{id}/download-ttd', [ArsipSuratController::class, 'downloadTtd'])->name('download-ttd');
                Route::get('/{id}/download/cetak', [ArsipSuratController::class, 'downloadCetak'])->name('download.cetak');
            });
    });
});
