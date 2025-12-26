<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SktmController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengajuanDokumenController;

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
            Route::get('/{id}', [SktmController::class, 'detail'])->name('detail');
            Route::put('/update/{id}', [SktmController::class, 'update'])->name('update');

            Route::post('/approve/{id}', [SktmController::class, 'approve'])->name('approve');
            Route::put('/reject/{id}', [SktmController::class, 'reject'])->name('reject');

            Route::get('/success/{file}', [SktmController::class, 'success'])->name('success');
            Route::get('/download/{file}', [SktmController::class, 'download'])->name('download');
        });
        Route::get('/pengajuan/{pengajuan}/dokumen/view', [PengajuanDokumenController::class, 'view'])
            ->name('pengajuan.dokumen.view');

        Route::get('/pengajuan/{pengajuan}/dokumen/download', [PengajuanDokumenController::class, 'download'])
            ->name('pengajuan.dokumen.download');
    });
});
