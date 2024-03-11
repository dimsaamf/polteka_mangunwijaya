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

Route::get('/dashboardwadir2', function () {
    return view('rolewadir.contentwadir.dashboardwadiru');
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
    return view('rolewadir.contentwadir.ubahpasswadir');
})->name('ubahpasswadir');

Route::get('/ubahppwadir', function () {
    return view('rolewadir.contentwadir.ubahppwadir');
})->name('ubahppwadir');

Route::get('/editpenggunasuperadmin', function () {
    return view('rolesuperadmin.contentsuperadmin.editpengguna');
})->name('editpenggunasuperadmin');

Route::get('/manajemensuperadmin', function () {
    return view('rolesuperadmin.contentsuperadmin.manajemen');
})->name('manajemenasuperadmin');

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

Route::get('/dashboardsuperadmin', function () {
    return view('dashboardsuperadmin');
});

Route::get('/dashboardprodiarmasi', function () {
    return view('dashboardprodifarmasi');
});

Route::get('/dashboardprodikimia', function () {
    return view('dashboardprodikimia');
});

Route::get('/dashboardkoorkimia', function () {
    return view('dashboardkoorkimia');
});

Route::get('/dashboardadminkimia', function () {
    return view('dashboardadminkimia');
});

Route::get('/notfound', function () {
    return view('notfound');
});