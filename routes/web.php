<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UserAspirasiController;
use App\Http\Controllers\UserKegiatanController;

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

Auth::routes();

Route::resource('/aspirasi', AspirasiController::class)->middleware('auth')->only(['index', 'update']);
Route::resource('/aspirasi', AspirasiController::class)->only(['store']);
Route::resource('/kategori', KategoriController::class)->middleware('auth');
Route::resource('/kegiatan', KegiatanController::class)->middleware('auth');
Route::get('/', [UserAspirasiController::class, 'index']);
Route::get('/user/kegiatan', [UserKegiatanController::class, 'index']);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
