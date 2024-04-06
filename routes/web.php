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
})->name('dashboardwadir');

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

Route::get('/dashboardkoorlabfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.dashboard');
})->name('dashboardkoorlabfarmasi');

Route::get('/ubahpwkoorlabfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.ubahpassword');
})->name('ubahpwkoorlabfarmasi');

Route::get('/ubahppkoorlabfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.ubahprofil');
})->name('ubahppkoorlabfarmasi');

Route::get('/databarangkoorlabfarmakognosi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.databarang');
})->name('databarangkoorlabfarmakognosi');

Route::get('/barangmasukkoorlabfarmakognosi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangmasuk');
})->name('barangmasukkoorlabfarmakognosi');

Route::get('/barangkeluarkoorlabfarmakognosi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangkeluar');
})->name('barangkeluarkoorlabfarmakognosi');

Route::get('/tambahbarangkoorlabfarmakognosi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.tambahbarang');
})->name('tambahbarangkoorlabfarmakognosi');

Route::get('/ubahbarangkoorlabfarmakognosi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.ubahbarang');
})->name('ubahbarangkoorlabfarmakognosi');

Route::get('/pengajuanbarangkoorlabfarmakognosi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.pengajuan');
})->name('pengajuanbarangkoorlabfarmakognosi');

Route::get('/tambahpengajuankoorlabfarmakognosi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.tambahpengajuan');
})->name('tambahpengajuankoorlabfarmakognosi');

Route::get('/databarangkoorlabfarmasetika', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.databarang');
})->name('databarangkoorlabfarmasetika');

Route::get('/barangmasukkoorlabfarmasetika', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangmasuk');
})->name('barangmasukkoorlabfarmasetika');

Route::get('/barangkeluarkoorlabfarmasetika', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangkeluar');
})->name('barangkeluarkoorlabfarmasetika');

Route::get('/tambahbarangkoorlabfarmasetika', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.tambahbarang');
})->name('tambahbarangkoorlabfarmasetika');

Route::get('/ubahbarangkoorlabfarmasetika', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.ubahbarang');
})->name('ubahbarangkoorlabfarmasetika');

Route::get('/pengajuanbarangkoorlabfarmasetika', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.pengajuan');
})->name('pengajuanbarangkoorlabfarmasetika');

Route::get('/tambahpengajuankoorlabfarmasetika', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.tambahpengajuan');
})->name('tambahpengajuankoorlabfarmasetika');

Route::get('/databarangkoorlabfarmasikimia', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasikimia.databarang');
})->name('databarangkoorlabfarmasikimia');

Route::get('/barangmasukkoorlabfarmasikimia', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasikimia.barangmasuk');
})->name('barangmasukkoorlabfarmasikimia');

Route::get('/barangkeluarkoorlabfarmasikimia', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasikimia.barangkeluar');
})->name('barangkeluarkoorlabfarmasikimia');

Route::get('/tambahbarangkoorlabfarmasikimia', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasikimia.tambahbarang');
})->name('tambahbarangkoorlabfarmasikimia');

Route::get('/ubahbarangkoorlabfarmasikimia', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasikimia.ubahbarang');
})->name('ubahbarangkoorlabfarmasikimia');

Route::get('/pengajuanbarangkoorlabfarmasikimia', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasikimia.pengajuan');
})->name('pengajuanbarangkoorlabfarmasikimia');

Route::get('/tambahpengajuankoorlabfarmasikimia', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labfarmasikimia.tambahpengajuan');
})->name('tambahpengajuankoorlabfarmasikimia');

Route::get('/databarangkoorlabtekfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.databarang');
})->name('databarangkoorlabtekfarmasi');

Route::get('/barangmasukkoorlabtekfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.barangmasuk');
})->name('barangmasukkoorlabtekfarmasi');

Route::get('/barangkeluarkoorlabtekfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.barangkeluar');
})->name('barangkeluarkoorlabtekfarmasi');

Route::get('/tambahbarangkoorlabtekfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.tambahbarang');
})->name('tambahbarangkoorlabtekfarmasi');

Route::get('/ubahbarangkoorlabtekfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.ubahbarang');
})->name('ubahbarangkoorlabtekfarmasi');

Route::get('/pengajuanbarangkoorlabtekfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.pengajuan');
})->name('pengajuanbarangkoorlabtekfarmasi');

Route::get('/tambahpengajuankoorlabtekfarmasi', function () {
    return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.tambahpengajuan');
})->name('tambahpengajuankoorlabtekfarmasi');

Route::get('/dashboardadminprodifarmasi', function () {
    return view('roleadminprodifarmasi.contentadminprodi.dashboard');
})->name('dashboardadminprodifarmasi');

Route::get('/ubahpwadminprodifarmasi', function () {
    return view('roleadminprodifarmasi.contentadminprodi.ubahpassword');
})->name('ubahpwadminprodifarmasi');

Route::get('/ubahppadminprodifarmasi', function () {
    return view('roleadminprodifarmasi.contentadminprodi.ubahprofil');
})->name('ubahppadminprodifarmasi');

Route::get('/databarangadminprodifarmasi', function () {
    return view('roleadminprodifarmasi.contentadminprodi.databarang');
})->name('databarangadminprodifarmasi');

Route::get('/barangmasukadminprodifarmasi', function () {
    return view('roleadminprodifarmasi.contentadminprodi.barangmasuk');
})->name('barangmasukadminprodifarmasi');

Route::get('/barangkeluaradminprodifarmasi', function () {
    return view('roleadminprodifarmasi.contentadminprodi.barangkeluar');
})->name('barangkeluaradminprodifarmasi');

Route::get('/tambahbarangadminprodifarmasi', function () {
    return view('roleadminprodifarmasi.contentadminprodi.tambahbarang');
})->name('tambahbarangadminprodifarmasi');

Route::get('/ubahbarangadminprodifarmasi', function () {
    return view('roleadminprodifarmasi.contentadminprodi.ubahbarang');
})->name('ubahbarangadminprodifarmasi');

Route::get('/notfound', function () {
    return view('notfound');
});