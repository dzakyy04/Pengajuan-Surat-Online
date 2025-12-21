<?php

use App\Http\Controllers\Admin\SktmController;
use App\Http\Controllers\MasyarakatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminSuratController;
use App\Http\Controllers\DemoController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/login', [AuthController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])->name('index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::prefix('sktm')->name('sktm.')->group(function () {
            Route::get('/', [SktmController::class, 'index'])->name('index');
            Route::get('/detail/{id}', [SktmController::class, 'detail'])->name('detail');
            Route::put('/update/{id}', [SktmController::class, 'update'])->name('update');


            Route::post('/approve/{id}', [SktmController::class, 'approve'])->name('approve');
            Route::put('/reject/{id}', [SktmController::class, 'reject'])->name('reject');

            Route::get('/success/{file}', [SktmController::class, 'success'])->name('success');
            Route::get('/download/{file}', [SktmController::class, 'download'])->name('download');
        });
    });

});

Route::get('/', [MasyarakatController::class, 'index'])->name('beranda');
Route::get('/form-pengajuan', [MasyarakatController::class, 'form'])->name('pengajuan');
