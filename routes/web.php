<?php

use App\KabKota;
use App\Kecamatan;
use App\KelDesa;

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
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

Route::get('/', 'SiteController@index');
Route::get('barang', 'SiteController@barang')->name('barang');
Route::get('getKab/{id}', function ($id) {
    $kab = KabKota::where('d_provinsi_id',$id)->get();
    return response()->json($kab);
});
Route::get('getKec/{id}', function ($id) {
    $kec = Kecamatan::where('d_kab_kota_id',$id)->get();
    return response()->json($kec);
});
Route::get('getKelDesa/{id}', function ($id) {
    $kel = KelDesa::where('d_kecamatan_id',$id)->get();
    return response()->json($kel);
});
Route::get('lelang/detail/{id}', 'SiteController@detail');