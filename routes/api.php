<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// daftar route
Route::post('/login', 'Api\AuthController@login');
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('cek-token', 'Api\UserController@cek_token');
    Route::apiResource('/guru', 'Api\GuruController');
    Route::apiResource('/users', 'Api\UserController');
    Route::apiResource('/mapel', 'Api\MapelController');
    Route::apiResource('/kelas', 'Api\KelasController')->parameters(['kelas' =>'kelas']);
    Route::apiResource('/siswa', 'Api\SiswaController');
    Route::apiResource('/jadwal', 'Api\JadwalController');
    Route::get('/user-untuk-guru','Api\UserController@get_user_guru');
    Route::apiResource('/presensi', 'Api\PresensiController');
    Route::get('get-siswa/{jadwal}', 'Api\JadwalController@get_siswa');
    });