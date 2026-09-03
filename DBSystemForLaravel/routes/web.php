<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BushoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShainController;

Route::get('/', function () {
    return redirect()->route('shain.index');
});

// ログインしていない利用者もアクセスできる認証用ルートです。
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// 以下の社員・部署管理画面は、ログイン済みの社員だけが使用できます。
Route::middleware('shain.auth')->group(function () {
    Route::get('/busho', [BushoController::class, 'index'])->name('busho.index');
    Route::get('/busho/sakusei', [BushoController::class, 'sakusei'])->name('busho.sakusei');
    Route::post('/busho/hozon', [BushoController::class, 'hozon'])->name('busho.hozon');

    Route::get('/busho/edit/{id}', [BushoController::class, 'edit'])->name('busho.edit');
    Route::put('/busho/update/{id}', [BushoController::class, 'update'])->name('busho.update');
    Route::delete('/busho/delete/{id}', [BushoController::class, 'delete'])->name('busho.delete');

    Route::get('/shain', [ShainController::class, 'index'])->name('shain.index');
    Route::get('/shain/sakusei', [ShainController::class, 'sakusei'])->name('shain.sakusei');
    Route::post('/shain/hozon', [ShainController::class, 'hozon'])->name('shain.hozon');
    Route::get('/shain/edit/{id}', [ShainController::class, 'edit'])->name('shain.edit');
    Route::put('/shain/update/{id}', [ShainController::class, 'update'])->name('shain.update');
    Route::delete('/shain/delete/{id}', [ShainController::class, 'delete'])->name('shain.delete');
});
