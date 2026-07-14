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