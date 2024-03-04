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
});

Route::get('/dashboardwadir2', function () {
    return view('rolewadir.contentwadir.dashboardwadiru');
});

Route::get('/laporanlabwadir', function () {
    return view('rolewadir.contentwadir.laporanlab');
});

Route::get('/laporanprodiwadir', function () {
    return view('rolewadir.contentwadir.laporanprodi');
});

Route::get('/pengajuanwadir', function () {
    return view('rolewadir.contentwadir.pengajuanbarang');
});

Route::get('/ubahpasswadir', function () {
    return view('ubahpasswadir');
});

Route::get('/ubahpasswadir', function () {
    return view('ubahpasswadir');
});

Route::get('/ubahppwadir', function () {
    return view('ubahppwadir');
});

Route::get('/dashboardsuperadmin', function () {
    return view('dashboardsuperadmin');
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