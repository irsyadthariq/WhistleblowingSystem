<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuangLingkupController;
use App\Http\Controllers\PertanyaanController; 
use App\Http\Controllers\MappingPertanyaanController;
use App\Http\Controllers\TabelLaporanHeaderController;
use App\Http\Controllers\TabelLaporanDetailController;
use App\Http\Controllers\TabelLaporanHeadingController;
use App\Http\Controllers\FaqController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// RuangLingkupController
Route::get('/ruang-lingkup', [RuangLingkupController::class, 'index']);
Route::post('/ruang-lingkup/store', [RuangLingkupController::class, 'store']);
Route::post('/ruang-lingkup/del', [RuangLingkupController::class, 'delete']);

// PertanyaanController
Route::get('/pertanyaan', [PertanyaanController::class, 'index']);
Route::post('/pertanyaan/store', [PertanyaanController::class, 'store']);
Route::post('/pertanyaan/del', [PertanyaanController::class, 'delete']);

// MappingPertanyaanController
Route::get('/mapping-pertanyaan', [MappingPertanyaanController::class, 'index']);
Route::post('/mapping-pertanyaan/store', [MappingPertanyaanController::class, 'store']);
Route::post('/mapping-pertanyaan/del', [MappingPertanyaanController::class, 'delete']);

// TabelLaporanHeaderController
Route::get('/tabel-laporan-header', [TabelLaporanHeaderController::class, 'index']);
Route::post('/tabel-laporan-header/store', [TabelLaporanHeaderController::class, 'store']);
Route::post('/tabel-laporan-header/del', [TabelLaporanHeaderController::class, 'delete']);

// TabelLaporanDetailController
Route::get('/tabel-laporan-detail', [TabelLaporanDetailController::class, 'index']);
Route::post('/tabel-laporan-detail/store', [TabelLaporanDetailController::class, 'store']);
Route::post('/tabel-laporan-detail/del', [TabelLaporanDetailController::class, 'delete']);

// TabelLaporanHeadingController
Route::get('/tabel-laporan-heading', [TabelLaporanHeadingController::class, 'index']);
Route::post('/tabel-laporan-heading/store', [TabelLaporanHeadingController::class, 'store']);
Route::post('/tabel-laporan-heading/del', [TabelLaporanHeadingController::class, 'delete']);

// FaqController
Route::get('/faq', [FaqController::class, 'index']);
Route::post('/faq/store', [FaqController::class, 'store']);
Route::put('/faq/update/{id}', [FaqController::class, 'update']);
Route::delete('/faq/delete/{id}', [FaqController::class, 'destroy']);