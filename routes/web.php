<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\DataKelulusanController;
use App\Http\Controllers\KenaikanKelasController;
use App\Http\Controllers\TambahTagihanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteSer
viceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::resource('/kelas', KelasController::class);

    Route::get('/siswa/filter-data', [SiswaController::class, 'filterData']);
    Route::get('/siswa/export/', [SiswaController::class, 'export'])->name('siswa.export');
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    Route::get('/download-excel/{filename}', [SiswaController::class, 'downloadExcel'])->name('download-excel');
    Route::resource('/siswa', SiswaController::class);

    Route::resource('/tahun-ajaran', TahunAjaranController::class);
    Route::resource('/biaya', BiayaController::class);

    Route::get('/kenaikan-kelas/filter-data', [KenaikanKelasController::class, 'getOldData']);
    Route::POST('/kenaikan-kelas/update', [KenaikanKelasController::class, 'update']);
    Route::get('/kenaikan-kelas', [KenaikanKelasController::class, 'index']);

    Route::get('/kelulusan/filter-data', [KelulusanController::class, 'getOldData']);
    Route::POST('/kelulusan/proses-lulus', [KelulusanController::class, 'prosesLulus'])->name('proses-lulus');
    Route::get('/kelulusan', [KelulusanController::class, 'index']);

    Route::get('/tambah-tagihan', [TambahTagihanController::class, 'index']);
});

Route::middleware(['auth', 'IsSiswa'])->group(function () {
    Route::get('/tagihan', [TagihanController::class, 'index']);
});
