<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuangLingkupController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\MappingPertanyaanController;
use App\Http\Controllers\TabelLaporanHeaderController;
use App\Http\Controllers\TabelLaporanDetailController;
use App\Http\Controllers\SaluranPelaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FaqController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ruang lingkup
Route::get('/ruang-lingkup', [RuangLingkupController::class, 'index']);
Route::post('/ruang-lingkup/store', [RuangLingkupController::class, 'store']);
Route::post('/ruang-lingkup/del', [RuangLingkupController::class, 'delete']);

// pertanyaan
Route::get('/pertanyaan', [PertanyaanController::class, 'index']);
Route::post('/pertanyaan/store', [PertanyaanController::class, 'store']);
Route::post('/pertanyaan/del', [PertanyaanController::class, 'delete']);

// Mapping Pertanyaan
Route::get('/mapping-pertanyaan', [MappingPertanyaanController::class, 'index']);
Route::get('/mapping-pertanyaan/{ruang_lingkup_id}', [MappingPertanyaanController::class, 'detail']);
Route::post('/mapping-pertanyaan/store', [MappingPertanyaanController::class, 'store']);
Route::post('/mapping-pertanyaan/del', [MappingPertanyaanController::class, 'delete']);

// Laporan Header
Route::get('/laporan-header', [TabelLaporanHeaderController::class, 'index']);
Route::get('/laporan-header/{laporan_id}', [TabelLaporanHeaderController::class, 'detail']);
Route::post('/laporan-header/store', [TabelLaporanHeaderController::class, 'store']);
Route::post('/laporan-header/del', [TabelLaporanHeaderController::class, 'delete']);

// Laporan Detail
Route::get('/laporan-detail', [TabelLaporanDetailController::class, 'index']);
Route::get('/laporan-detail/{t_laporan_header_id}', [TabelLaporanDetailController::class, 'detail']);
Route::post('/laporan-detail/store', [TabelLaporanDetailController::class, 'store']);
Route::post('/laporan-detail/del', [TabelLaporanDetailController::class, 'delete']);

Route::get('/saluran-pelaporan', [SaluranPelaporanController::class, 'index']);
Route::get('/saluran-pelaporan/{tahun}', [SaluranPelaporanController::class, 'detail']);
Route::post('/saluran-pelaporan/store', [SaluranPelaporanController::class, 'store']);
Route::post('/saluran-pelaporan/del', [SaluranPelaporanController::class, 'delete']);

// Laporan Faq
Route::get('/faq', [FaqController::class, 'index']);
Route::post('/faq/store', [FaqController::class, 'store']);
Route::post('/faq/del', [FaqController::class, 'delete']);

Route::get('/data', 'App\Http\Controllers\APIController@index');
