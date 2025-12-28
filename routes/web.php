<?php

use App\Http\Controllers\SkdController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SktmController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\SkpController;
use App\Http\Controllers\SkuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MasyarakatController::class, 'index'])->name('beranda');
Route::get('/form-pengajuan', [MasyarakatController::class, 'form'])->name('pengajuan');
Route::post('/form-pengajuan', [MasyarakatController::class, 'submitForm'])->name('pengajuan.submit');

Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Admin
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Surat Keterangan Tidak Mampu (SKTM)
        Route::prefix('sktm')->name('sktm.')->group(function () {
            Route::get('/', [SktmController::class, 'index'])->name('index');
            Route::get('/success/{file}', [SktmController::class, 'success'])->name('success');
            Route::get('/download/{file}', [SktmController::class, 'download'])->name('download');

            Route::get('/{id}', [SktmController::class, 'detail'])->name('detail');
            Route::put('/{id}', [SktmController::class, 'update'])->name('update');
            Route::post('/{id}/approve', [SktmController::class, 'approve'])->name('approve');
            Route::put('/{id}/reject', [SktmController::class, 'reject'])->name('reject');
            Route::post('/{id}/upload-ttd', [SktmController::class, 'uploadTtd'])->name('upload-ttd');
            Route::get('/{id}/download-ttd', [SktmController::class, 'downloadTtd'])->name('download-ttd');
            Route::get('/{id}/print', [SktmController::class, 'print'])->name('print');
        });

        // Surat Keterangan Domisili (SKD)
        Route::prefix('skd')->name('skd.')->group(function () {
            Route::get('/', [SkdController::class, 'index'])->name('index');
            Route::get('/success/{file}', [SkdController::class, 'success'])->name('success');
            Route::get('/download/{file}', [SkdController::class, 'download'])->name('download');

            Route::get('/{id}', [SkdController::class, 'detail'])->name('detail');
            Route::put('/{id}', [SkdController::class, 'update'])->name('update');
            Route::post('/{id}/approve', [SkdController::class, 'approve'])->name('approve');
            Route::put('/{id}/reject', [SkdController::class, 'reject'])->name('reject');
            Route::post('/{id}/upload-ttd', [SkdController::class, 'uploadTtd'])->name('upload-ttd');
            Route::get('/{id}/download-ttd', [SkdController::class, 'downloadTtd'])->name('download-ttd');
            Route::get('/{id}/print', [SkdController::class, 'print'])->name('print');
        });

        // Surat Keterangan Usaha (SKU)
        Route::prefix('sku')->name('sku.')->group(function () {
            Route::get('/', [SkuController::class, 'index'])->name('index');
            Route::get('/success/{file}', [SkuController::class, 'success'])->name('success');
            Route::get('/download/{file}', [SkuController::class, 'download'])->name('download');

            Route::get('/{id}', [SkuController::class, 'detail'])->name('detail');
            Route::put('/{id}', [SkuController::class, 'update'])->name('update');
            Route::post('/{id}/approve', [SkuController::class, 'approve'])->name('approve');
            Route::put('/{id}/reject', [SkuController::class, 'reject'])->name('reject');
            Route::post('/{id}/upload-ttd', [SkuController::class, 'uploadTtd'])->name('upload-ttd');
            Route::get('/{id}/download-ttd', [SkuController::class, 'downloadTtd'])->name('download-ttd');
            Route::get('/{id}/print', [SkuController::class, 'print'])->name('print');
        });

        // Surat Keterangan Penghasilan (SKU)
        Route::prefix('skp')->name('skp.')->group(function () {
            Route::get('/', [SkpController::class, 'index'])->name('index');
            Route::get('/success/{file}', action: [SkpController::class, 'success'])->name('success');
            Route::get('/download/{file}', [SkpController::class, 'download'])->name('download');

            Route::get('/{id}', [SkpController::class, 'detail'])->name('detail');
            Route::put('/{id}', [SkpController::class, 'update'])->name('update');
            Route::post('/{id}/approve', [SkpController::class, 'approve'])->name('approve');
            Route::put('/{id}/reject', [SkpController::class, 'reject'])->name('reject');
            Route::post('/{id}/upload-ttd', [SkpController::class, 'uploadTtd'])->name('upload-ttd');
            Route::get('/{id}/download-ttd', [SkpController::class, 'downloadTtd'])->name('download-ttd');
            Route::get('/{id}/print', [SkpController::class, 'print'])->name('print');
        });

        Route::get('/pengajuan/{pengajuan}/dokumen/view', [PengajuanDokumenController::class, 'view'])
            ->name('pengajuan.dokumen.view');

        Route::get('/pengajuan/{pengajuan}/dokumen/download', [PengajuanDokumenController::class, 'download'])
            ->name('pengajuan.dokumen.download');
    });
});
