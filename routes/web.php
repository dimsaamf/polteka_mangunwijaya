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