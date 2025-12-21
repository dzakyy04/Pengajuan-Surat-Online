<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
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
Route::get('/admin/login', [AuthController::class, 'index'])->name('admin.dashboard');

Route::prefix('demo/admin')->name('demo.admin.')->group(function () {
    Route::get('/dashboard', [DemoController::class, 'dashboard'])->name('dashboard');
    Route::get('/detail', [DemoController::class, 'detail'])->name('detail');
    Route::post('/approve', [DemoController::class, 'approve'])->name('approve');
    Route::post('/reject', [DemoController::class, 'reject'])->name('reject');
    Route::get('/success/{file}', [DemoController::class, 'success'])->name('success');
    Route::get('/download/{file}', [DemoController::class, 'download'])->name('download');
});

// PEJABAT DEMO
Route::prefix('demo/pejabat')->name('demo.pejabat.')->group(function () {
    Route::get('/dashboard', [DemoController::class, 'pejabatDashboard'])->name('dashboard');
    Route::get('/detail', [DemoController::class, 'pejabatDetail'])->name('detail');
    Route::post('/sign', [DemoController::class, 'pejabatSign'])->name('sign');
    Route::get('/signed', [DemoController::class, 'pejabatSigned'])->name('signed');
});

// Redirect root ke demo admin
// Route::get('/', function () {
//     return redirect()->route('demo.admin.dashboard');
// });
