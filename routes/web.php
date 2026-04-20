<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa', [MahasiswaController::class, 'getData'])->name('mahasiswa.data');
