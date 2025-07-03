<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class,'index'])->name('dashboard')->middleware('auth');
Route::get('form',[FormController::class, 'index'])->name('form')->middleware('auth');
Route::post('/upload',[FormController::class, 'store'])->name('upload')->middleware('auth');
Route::post('/upload_ortu',[FormController::class, 'uploadOrtu'])->name('upload_ortu')->middleware('auth');
Route::post('/upload_alamat',[FormController::class, 'uploadAlamat'])->name('upload_alamat')->middleware('auth');
Route::get('/formulir_pribadi',[SiswaController::class, 'formPribadi'])->middleware('auth');
Route::get('/formulir_ortu',[SiswaController::class, 'formOrtu'])->middleware('auth');
Route::get('/formulir_alamat',[SiswaController::class, 'formAlamat'])->middleware('auth');

Route::get('/pendaftar',[PendaftarController::class, 'index'])->name('pendaftar')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/timeline', [TimelineController::class, 'index'])->name('timeline')->middleware('auth');
Route::post('/input_timeline', [TimelineController::class, 'store'])->name('input_timeline')->middleware('auth');