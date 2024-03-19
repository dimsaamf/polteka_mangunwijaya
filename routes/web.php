<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/dashboardwadir', function () {
    return view('rolewadir.contentwadir.dashboard');
})->name('dashboard');

Route::get('/laporanlabwadir', function () {
    return view('rolewadir.contentwadir.laporanlab');
})->name('laporanlabwadir');

Route::get('/laporanprodiwadir', function () {
    return view('rolewadir.contentwadir.laporanprodi');
})->name('laporanprodiwadir');

Route::get('/pengajuanwadir', function () {
    return view('rolewadir.contentwadir.pengajuanbarang');
})->name('pengajuanwadir');

Route::get('/ubahpasswadir', function () {
    return view('rolewadir.contentwadir.ubahpassword');
})->name('ubahpasswadir');

Route::get('/ubahppwadir', function () {
    return view('rolewadir.contentwadir.ubahpp');
})->name('ubahppwadir');

Route::get('/editpenggunasuperadmin', function () {
    return view('rolesuperadmin.contentsuperadmin.editpengguna');
})->name('editpenggunasuperadmin');

Route::get('/manajemensuperadmin', function () {
    return view('rolesuperadmin.contentsuperadmin.manajemen');
})->name('manajemensuperadmin');

Route::get('/pengajuanbarangsuperadmin', function () {
    return view('rolesuperadmin.contentsuperadmin.pengajuanbarang');
})->name('pengajuanbarangsuperadmin');

Route::get('/tambahpengajuansuperadmin', function () {
    return view('rolesuperadmin.contentsuperadmin.tambahpengajuan');
})->name('tambahpengajuansuperadmin');

Route::get('/tambahpenggunasuperadmin', function () {
    return view('rolesuperadmin.contentsuperadmin.tambahpengguna');
})->name('tambahpenggunasuperadmin');

Route::get('/ubahpwsuperadmin', function () {
    return view('rolesuperadmin.contentsuperadmin.ubahpassword');
})->name('ubahpwsuperadmin');

Route::get('/ubahppsuperadmin', function () {
    return view('rolesuperadmin.contentsuperadmin.ubahprofil');
})->name('ubahppsuperadmin');

Route::get('/dashboardadminlab', function () {
    return view('roleadminlab.contentadminlab.dashboard');
})->name('dashboardadminlab');

Route::get('/dashboardadminlabfarmasi', function () {
    return view('roleadminlabfarmasi.contentadminlab.dashboard');
})->name('dashboardadminlabfarmasi');

Route::get('/ubahpwadminlabfarmasi', function () {
    return view('roleadminlabfarmasi.contentadminlab.ubahpassword');
})->name('ubahpwadminlabfarmasi');

Route::get('/ubahppadminlabfarmasi', function () {
    return view('roleadminlabfarmasi.contentadminlab.ubahprofil');
})->name('ubahppadminlabfarmasi');

// lab tek farmasi
Route::get('/databarangadminlabtekfarmasi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.databarang');
})->name('databarangadminlabtekfarmasi');

Route::get('/barangmasukadminlabtekfarmasi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.barangmasuk');
})->name('barangmasukadminlabtekfarmasi');

Route::get('/barangkeluaradminlabtekfarmasi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.barangkeluar');
})->name('barangkeluaradminlabtekfarmasi');

Route::get('/tambahbarangadminlabtekfarmasi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.tambahbarang');
})->name('tambahbarangadminlabtekfarmasi');

Route::get('/ubahbarangadminlabtekfarmasi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.ubahbarang');
})->name('ubahbarangadminlabtekfarmasi');

Route::get('/databarangadminlabfarmakognosi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.databarang');
})->name('databarangadminlabfarmakognosi');

Route::get('/barangmasukadminlabfarmakognosi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.barangmasuk');
})->name('barangmasukadminlabfarmakognosi');

Route::get('/barangkeluaradminlabfarmakognosi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.barangkeluar');
})->name('barangkeluaradminlabfarmakognosi');

Route::get('/tambahbarangadminlabfarmakognosi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.tambahbarang');
})->name('tambahbarangadminlabfarmakognosi');

Route::get('/ubahbarangadminlabfarmakognosi', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.ubahbarang');
})->name('ubahbarangadminlabfarmakognosi');

Route::get('/databarangadminlabfarmasetika', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.databarang');
})->name('databarangadminlabfarmasetika');

Route::get('/barangmasukadminlabfarmasetika', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.barangmasuk');
})->name('barangmasukadminlabfarmasetika');

Route::get('/barangkeluaradminlabfarmasetika', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.barangkeluar');
})->name('barangkeluaradminlabfarmasetika');

Route::get('/tambahbarangadminlabfarmasetika', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.tambahbarang');
})->name('tambahbarangadminlabfarmasetika');

Route::get('/ubahbarangadminlabfarmasetika', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.ubahbarang');
})->name('ubahbarangadminlabfarmasetika');

Route::get('/databarangadminlabfarmasikimia', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.databarang');
})->name('databarangadminlabfarmasikimia');

Route::get('/barangmasukadminlabfarmasikimia', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.barangmasuk');
})->name('barangmasukadminlabfarmasikimia');

Route::get('/barangkeluaradminlabfarmasikimia', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.barangkeluar');
})->name('barangkeluaradminlabfarmasikimia');

Route::get('/tambahbarangadminlabfarmasikimia', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.tambahbarang');
})->name('tambahbarangadminlabfarmasikimia');

Route::get('/ubahbarangadminlabfarmasikimia', function () {
    return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.ubahbarang');
})->name('ubahbarangadminlabfarmasikimia');

Route::get('/notfound', function () {
    return view('notfound');
});