<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BushoController;

Route::get('/', function () {
    return view('welcome');
});
//部署一覧表示
Route::get('/busho', [BushoController::class, 'index'])->name('busho.index');
Route::get('/busho/sakusei', [BushoController::class, 'sakusei'])->name('busho.sakusei');
Route::post('/busho/hozon', [BushoController::class, 'hozon'])->name('busho.hozon');

Route::get('/busho/edit/{id}', [BushoController::class, 'edit'])->name('busho.edit');
Route::put('/busho/update/{id}', [BushoController::class, 'update'])->name('busho.update');
Route::delete('/busho/delete/{id}', [BushoController::class, 'delete'])->name('busho.delete');

//社員一覧表示
use App\Http\Controllers\ShainController;
Route::get('/shain', [ShainController::class, 'index'])->name('shain.index');
Route::get('/shain/sakusei', [ShainController::class, 'sakusei'])->name('shain.sakusei');
Route::post('/shain/hozon', [ShainController::class, 'hozon'])->name('shain.hozon');
Route::get('/shain/edit/{id}', [ShainController::class, 'edit'])->name('shain.edit');
Route::put('/shain/update/{id}', [ShainController::class, 'update'])->name('shain.update');
Route::delete('/shain/delete/{id}', [ShainController::class, 'delete'])->name('shain.delete');
