<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DataSetController;
use App\Http\Controllers\KomponenController;
use App\Http\Controllers\StreetLightController;
use App\Http\Controllers\DetailDataController;
use App\Http\Controllers\TagihanController;


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

Route::get('/', [LandingPageController::class, 'index'])->name('landingpages');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('postlogin');
Route::get('/logout',  [LoginController::class, 'logout'])->name('logout');



Route::group(['middleware' => ['auth', 'ceklevel:1']], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    //Data Set - Lokasi
    Route::get('/datset/lokasi', [DataSetController::class, 'location'])->name('location');
    Route::get('/datset/kecamatan/{name}', [DataSetController::class, 'location_desa'])->name('location_desa');
    Route::post('/datset/lokasi-desa', [DataSetController::class, 'store_desa'])->name('store.location');
    Route::put('/datset/kecamatan/{name}', [DataSetController::class, 'location_update']);
    Route::put('/datset/lokasi-desa/{id}', [DataSetController::class, 'location_desa_update']);
    Route::delete('/destroy-desa/{nama}', [DataSetController::class, 'destroy_desa'])->name('destroy.desa');

    //DataSet - Komponen || Merk
    Route::get('/komponen-merk', [KomponenController::class, 'show_merk'])->name('show.merk');
    Route::post('/komponen-merk', [KomponenController::class, 'store_merk'])->name('store.merk');
    Route::put('/komponen-merk/{id}', [KomponenController::class, 'update_merk'])->name('update.merk');
    Route::delete('/komponen-merk/{id}', [KomponenController::class, 'destroy_merk'])->name('destroy.merk');
    //DataSet - Komponen || Type
    Route::get('/komponen-type', [KomponenController::class, 'show_type'])->name('show.type');
    Route::post('/komponen-type', [KomponenController::class, 'store_type'])->name('store.type');
    Route::put('/komponen-type/{id}', [KomponenController::class, 'update_type'])->name('update.type');
    Route::delete('/komponen-type/{id}', [KomponenController::class, 'destroy_type'])->name('destroy.type');
    //DataSet - Komponen || Tarif
    Route::get('/komponen-tarif', [KomponenController::class, 'show_tarif'])->name('show.tarif');
    Route::post('/komponen-tarif', [KomponenController::class, 'store_tarif'])->name('store.tarif');
    Route::put('/komponen-tarif/{id}', [KomponenController::class, 'update_tarif'])->name('update.tarif');
    Route::delete('/komponen-tarif/{id}', [KomponenController::class, 'destroy_tarif'])->name('destroy.tarif');
    //DataSet - Komponen || IDPEL
    Route::get('/komponen-idpel', [KomponenController::class, 'show_idpel'])->name('show.idpel');
    Route::post('/komponen-idpel', [KomponenController::class, 'store_idpel'])->name('store.idpel');
    Route::put('/komponen-idpel/{id}', [KomponenController::class, 'update_idpel'])->name('update.idpel');
    Route::delete('/komponen-idpel/{id}', [KomponenController::class, 'destroy_idpel'])->name('destroy.idpel');

    //Daftar Lampu Jalan
    Route::get('/lampu-jalan', [StreetLightController::class, 'show_light'])->name('show.light');
    Route::get('/lampu-jalan/store', [StreetLightController::class, 'store_light'])->name('store.light');
    Route::post('/lampu-jalan/store', [StreetLightController::class, 'add_light'])->name('add.light');
    Route::get('/lampu-jalan/update/{id}', [StreetLightController::class, 'show_update_light'])->name('show.update.light');
    Route::put('/lampu-jalan/update/{id}', [StreetLightController::class, 'update_light'])->name('update.light');
    Route::delete('/lampu-jalan/delete/{id}', [StreetLightController::class, 'delete_light'])->name('delete.light');
    Route::get('/lampu-jalan/get-desa', [StreetLightController::class, 'get_desa'])->name('admin.get.desa');
    Route::get('/lampu-jalan/get-panel', [StreetLightController::class, 'get_panel'])->name('admin.get.panel');

    //Detail Data - Panel
    Route::get('/detail/panel', [DetailDataController::class, 'index_panel'])->name('index.panel');
    //Detail Data - Panel - ajax
    Route::get('/detail/panel/cari', [DetailDataController::class, 'cari_panel'])->name('panel.cari');
    Route::get('/detail/panel/get', [DetailDataController::class, 'panel_get_det'])->name('get.panel.det');

    //Detail Data - Desa
    Route::get('/detail/desa', [DetailDataController::class, 'index_desa'])->name('index.desa');
    //Detail Data - desa - ajax
    Route::get('/detail/desa/cari', [DetailDataController::class, 'cari_desa'])->name('desa.cari');
    Route::get('/detail/desa/get', [DetailDataController::class, 'desa_get_det'])->name('desa.get.det');

    //Detail Data - Camat
    Route::get('/detail/kecamatan', [DetailDataController::class, 'index_camat'])->name('index.camat');
    //Detail Data - camat - ajax
    Route::get('/detail/camat/cari', [DetailDataController::class, 'cari_camat'])->name('camat.cari');
    Route::get('/detail/camat/get', [DetailDataController::class, 'camat_get_det'])->name('camat.get.det');



    //DataSet - Tagihan ||
    Route::get('/tagihan', [TagihanController::class, 'index_tagihan'])->name('index.tagihan');
    Route::post('/tagihan/tambah', [TagihanController::class, 'tambah_tagihan'])->name('add.tagihan');
    Route::get('/tagihan/get-panel', [TagihanController::class, 'get_panel_daya'])->name('admin.get.panel.daya');
    Route::get('/tagihan/get-tabel-jam', [TagihanController::class, 'get_tagihan_jam'])->name('get.tagihan.jam');
    Route::get('/tagihan/get-tabel-daya', [TagihanController::class, 'get_tagihan_daya'])->name('get.tagihan.daya');
    Route::get('/tagihan/get-detail', [TagihanController::class, 'get_tagihan_detail'])->name('get.tagihan.detail');
    Route::delete('/tagihan/{id}', [TagihanController::class, 'hapus_tagihan'])->name('delete.tagihan');

    //DataSet - Tagihan Bulan ||
    Route::get('/tagihan/bulan', [TagihanController::class, 'index_tagihan_bulan'])->name('index.tagihan.bulan');
    Route::get('/tagihan/panel', [TagihanController::class, 'index_tagihan_panel'])->name('index.tagihan.panel');

    //Detail Data - bulan - ajax
    Route::get('/tagihan/bulan/cari', [TagihanController::class, 'cari_bulan'])->name('bulan.cari');
    Route::get('/tagihan/bulan/cari-daya', [TagihanController::class, 'cari_bulan_daya'])->name('bulan.cari.daya');
    Route::get('/tagihan/bulan/get-tabel-jam', [TagihanController::class, 'bulan_get_tagihan_jam'])->name('bulan.get.tagihan.jam');
    Route::get('/tagihan/bulan/get-tabel-daya', [TagihanController::class, 'bulan_get_tagihan_daya'])->name('bulan.get.tagihan.daya');
    Route::get('/tagihan/panel/get-tabel-jam', [TagihanController::class, 'panel_get_tagihan_jam'])->name('panel.get.tagihan.jam');
    Route::get('/tagihan/panel/get-tabel-daya', [TagihanController::class, 'panel_get_tagihan_daya'])->name('panel.get.tagihan.daya');
    Route::get('/tagihan/panel/cari-jam', [TagihanController::class, 'cari_panel_jam'])->name('panel.cari.jam');
    Route::get('/tagihan/panel/cari-daya', [TagihanController::class, 'cari_panel_daya'])->name('panel.cari.daya');
});
