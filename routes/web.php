<?php

use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class,'index'])->name('dashboard')->middleware('auth');
Route::get('form',[FormController::class, 'index'])->name('form')->middleware('auth');
Route::post('/upload',[FormController::class, 'store'])->name('upload')->middleware('auth');
Route::post('/upload_ortu',[FormController::class, 'uploadOrtu'])->name('upload_ortu')->middleware('auth');
Route::post('/upload_alamat',[FormController::class, 'uploadAlamat'])->name('upload_alamat')->middleware('auth');
Route::post('/siswa_delete',[FormController::class, 'destroy'])->name('siswa_delete')->middleware('auth');
Route::post('/update_form_siswa',[FormController::class, 'updateFormSiswa'])->name('update_form_siswa')->middleware('auth');
Route::post('/update_form_ortu',[FormController::class, 'updateFormOrtu'])->name('update_form_ortu')->middleware('auth');
Route::post('/update_form_alamat',[FormController::class, 'updateFormAlamat'])->name('update_form_alamat')->middleware('auth'); 
Route::get('/formulir_pribadi',[SiswaController::class, 'formPribadi'])->middleware('auth');
Route::get('/formulir_ortu',[SiswaController::class, 'formOrtu'])->middleware('auth');
Route::get('/formulir_alamat',[SiswaController::class, 'formAlamat'])->middleware('auth');
Route::get('/berkas',[BerkasController::class, 'index'])->name('berkas')->middleware('auth');
Route::post('/upload_berkas',[BerkasController::class, 'store'])->name('upload_berkas')->middleware('auth');


Route::get('/pendaftar',[PendaftarController::class, 'index'])->name('pendaftar')->middleware('auth');
Route::get('/verifikasi',[VerifikasiController::class, 'index'])->name('verifikasi')->middleware('auth');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::get('/profile_edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::get('/hapus_siswa/{id}', [PendaftarController::class, 'destroy'])->name('hapus_siswa')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/timeline', [TimelineController::class, 'index'])->name('timeline')->middleware('auth');
Route::post('/timeline/upload-image', [TimelineController::class, 'uploadImage'])->name('timeline.upload-image');
Route::post('/timeline/upload-temp-image', [TimelineController::class, 'uploadTempImage'])->name('timeline.upload-temp-image');
Route::post('/timeline/cleanup-temp', [TimelineController::class, 'cleanupSpecificTempImages'])->name('timeline.cleanup-temp');
Route::get('/hapus_timeline/{id}', [TimelineController::class, 'destroy'])->name('hapus_timeline')->middleware('auth');
Route::post('/input_timeline', [TimelineController::class, 'store'])->name('input_timeline')->middleware('auth');
Route::get('/edit_timeline-{id}', [TimelineController::class, 'edit'])->name('edit_timeline')->middleware('auth');
Route::post('/update_timeline/{id}', [TimelineController::class, 'update'])->name('update_timeline')->middleware('auth');
Route::get('/edit_siswa-{id}', [PendaftarController::class, 'editSiswa'])->name('edit_siswa')->middleware('auth');
Route::post('/update_siswa/{id}', [PendaftarController::class, 'updateSiswa'])->name('update_siswa')->middleware('auth');
Route::get('/detail_verifikasi-{nisn}', [PendaftarController::class, 'detailVerifikasi'])->name('detail_verifikasi')->middleware('auth');