<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

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
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/kelas', KelasController::class);

Route::get('/siswa/filter-data', [SiswaController::class, 'filterData']);
Route::get('/siswa/export/', [SiswaController::class, 'export'])->name('siswa.export');;
Route::resource('/siswa', SiswaController::class);
