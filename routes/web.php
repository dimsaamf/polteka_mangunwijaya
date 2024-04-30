<?php

use App\Http\Controllers\Superadmin\ManajemenUserController;
use App\Http\Controllers\Superadmin\PengajuanSuperadminController;
use App\Http\Controllers\Wakildirektur\DashboardWadirController;
use App\Http\Controllers\Wakildirektur\PengajuanWadirController;
use App\Http\Controllers\Wakildirektur\LaporanWadirController;
use App\Http\Controllers\KoorAdminLabFarmasi\DashboardKoorAdminLabFarmasiController;
use App\Http\Controllers\KoorAdminLabFarmasi\BarangMasukFarmakognosiController;
use App\Http\Controllers\KoorAdminLabFarmasi\BarangKeluarFarmakognosiController;
use App\Http\Controllers\KoorAdminLabFarmasi\InventarislabFarmakognosiController;
use App\Http\Controllers\KoorAdminLabFarmasi\BarangMasukFarmasetikaController;
use App\Http\Controllers\KoorAdminLabFarmasi\BarangKeluarFarmasetikaController;
use App\Http\Controllers\KoorAdminLabFarmasi\InventarislabFarmasetikaController;
use App\Http\Controllers\KoorAdminLabFarmasi\BarangMasukKimiaController;
use App\Http\Controllers\KoorAdminLabFarmasi\BarangKeluarKimiaController;
use App\Http\Controllers\KoorAdminLabFarmasi\InventarislabKimiaController;
use App\Http\Controllers\KoorAdminLabFarmasi\BarangMasukTekfarmasiController;
use App\Http\Controllers\KoorAdminLabFarmasi\BarangKeluarTekfarmasiController;
use App\Http\Controllers\KoorAdminLabFarmasi\InventarislabTekfarmasiController;
use App\Http\Controllers\KoorAdminLabFarmasi\PengajuanBarangLabFarmasiController;
use App\Http\Controllers\AdminProdiFarmasi\DashboardFarmasiController;
use App\Http\Controllers\AdminProdiFarmasi\BarangMasukFarmasiController;
use App\Http\Controllers\AdminProdiFarmasi\BarangKeluarFarmasiController;
use App\Http\Controllers\AdminProdiFarmasi\InventarisFarmasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [SesiController::class, 'index'])->name("login");
Route::post('/login', [SesiController::class, 'login']);
Route::post('/logout',[SesiController::class, 'logout'])->name("logout");
Route::fallback(function (){
    return view('notfound');
});


Route::middleware(['auth', 'user.role:superadmin', 'revalidate'])->group(function (){
    Route::get('/superadmin/manajemenuser',[ManajemenUserController::class, 'index'])->name('manajemensuperadmin');
    Route::get('/superadmin/tambahpengguna',[ManajemenUserController::class, 'create'])->name('tambahpenggunasuperadmin');
    Route::post('/superadmin/tambahpengguna', [ManajemenUserController::class, 'store'])->name('manajemen-user.store');
    Route::get('/superadmin/ubahpengguna/{id}', [ManajemenUserController::class, 'edit'])->name('editpenggunasuperadmin');
    Route::post('/superadmin/ubahpengguna/{id}', [ManajemenUserController::class, 'update'])->name('updatepenggunasuperadmin');
    Route::delete('/superadmin/hapuspengguna/{id}', [ManajemenUserController::class, 'destroy'])->name('hapuspenggunasuperadmin');
    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/superadmin/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppsuperadmin');
    Route::post('/superadmin/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name("update.picture.superadmin");
    Route::get('/superadmin/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpwsuperadmin');
    Route::post('/superadmin/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.superadmin');
    Route::get('/superadmin/pengajuanbarang', [PengajuanSuperadminController::class, 'getpengajuankoorlabfarmasi'])->name('pengajuanbarangsuperadmin');
    Route::get('/superadmin/detailpengajuanbarang/{id}', [PengajuanSuperadminController::class, 'detailPengajuanKoorLabFarmasi'])->name('detailpengajuansuperadmin');
    Route::get('/preview-surat-superadmin/{id}', [PengajuanSuperadminController::class, 'previewSurat'])->name('preview.suratsuperadmin');
});

Route::middleware(['auth', 'user.role:wakildirektur', 'revalidate'])->group(function (){
    Route::get('/wakildirektur/dashboard',[DashboardWadirController::class, 'index'])->name('dashboardwadir');
    Route::get('/wakildirektur/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppwadir');
    Route::post('/wakildirektur/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name("update.picture.wadir");
    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/wakildirektur/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpasswadir');
    Route::post('/wakildirektur/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.wadir');
    Route::get('/wakildirektur/pengajuanbarang', [PengajuanWadirController::class, 'getpengajuan'])->name('pengajuanwadir');
    Route::put('/wakildirektur/pengajuanbarang/{id}', [PengajuanWadirController::class, 'updateStatus'])->name('updatestatuskoorlabfarmasi');
    Route::get('/wakildirektur/status', [PengajuanWadirController::class, 'getStatusOptions'])->name('getStatusOptions');
    Route::get('/wakildirektur/detailpengajuanbarang/{id}', [PengajuanWadirController::class, 'detailPengajuanKoorLabFarmasi'])->name('detailpengajuanwadir');
    Route::get('/preview-surat-wadir/{id}', [PengajuanWadirController::class, 'previewSurat'])->name('preview.suratwadir');
    Route::get('/wakildirektur/laporanlaboratorium',[LaporanWadirController::class, 'laporanlab'])->name('laporanlabwadir');
    Route::get('/wakildirektur/laporanprodi',[LaporanWadirController::class, 'laporanprodi'])->name('laporanprodiwadir');
    Route::post('/wakildirektur/laporanlaboratorium', [LaporanWadirController::class, 'previewLaporan'])->name('tampilkanLaporan');
    Route::post('/wakildirektur/laporanprodi', [LaporanWadirController::class, 'previewLaporanProdi'])->name('tampilkanLaporanProdi');
    Route::get('/wakildirektur/get-barcode/{id}', [InventarisLabfarmakognosiController::class, 'getBarcode'])->name('get.barcode.invlabfarmakognosi');


});

Route::middleware(['auth', 'user.role:koorlabprodfarmasi', 'revalidate'])->group(function (){
    Route::get('/koorlabfarmasi/dashboard',[DashboardKoorAdminLabFarmasiController::class, 'index'])->name('dashboardkoorlabfarmasi');
    Route::post('/koorlabfarmasi/dashboard', [DashboardKoorAdminLabFarmasiController::class, 'updateNotification'])->name('update.notification');

    Route::get('/koorlabfarmasi/labfarmakognosi/databarang', [InventarislabFarmakognosiController::class, 'index'])->name('databarangkoorlabfarmakognosi');
    Route::delete('/koorlabfarmasi/labfarmakognosi/databarang/{id}', [InventarislabFarmakognosiController::class, 'destroy'])->name('hapusbarangfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/tambahbarang', [InventarislabFarmakognosiController::class, 'create'])->name('tambahbarangkoorlabfarmakognosi');
    Route::post('/koorlabfarmasi/labfarmakognosi/tambahbarang', [InventarislabFarmakognosiController::class, 'store'])->name('tambahbarangkoorlabfarmakognosi.store');
    Route::get('/koorlabfarmasi/labfarmakognosi/ubahbarang/{id}', [InventarislabFarmakognosiController::class, 'edit'])->name('ubahbarangkoorlabfarmakognosi');
    Route::post('/koorlabfarmasi/labfarmakognosi/ubahbarang/{id}', [InventarislabFarmakognosiController::class, 'update'])->name('updatebarangkoorlabfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/gambar/{id}', [InventarislabFarmakognosiController::class, 'getGambar'])->name('get.gambar.invlabfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/riwayatbarangmasuk', [BarangMasukFarmakognosiController::class, 'index'])->name('riwayatbarangmasukkoorlabfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/riwayatbarangkeluar', [BarangKeluarFarmakognosiController::class, 'index'])->name('riwayatbarangkeluarkoorlabfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/barangmasuk', [BarangMasukFarmakognosiController::class, 'tabel'])->name('barangmasukkoorlabfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/barangkeluar', [BarangKeluarFarmakognosiController::class, 'tabel'])->name('barangkeluarkoorlabfarmakognosi');
    Route::post('/koorlabfarmasi/labfarmakognosi/barangmasuk', [BarangMasukFarmakognosiController::class, 'store'])->name('barangmasukkoorlabfarmakognosi.store');
    Route::post('/koorlabfarmasi/labfarmakognosi/barangkeluar', [BarangKeluarFarmakognosiController::class, 'store'])->name('barangkeluarkoorlabfarmakognosi.store');

    Route::get('/koorlabfarmasi/labfarmasetika/databarang', [InventarisLabFarmasetikaController::class, 'index'])->name('databarangkoorlabfarmasetika');
    Route::delete('/koorlabfarmasi/labfarmasetika/databarang/{id}', [InventarisLabFarmasetikaController::class, 'destroy'])->name('hapusbarangfarmasetika');
    Route::get('/koorlabfarmasi/labfarmasetika/tambahbarang', [InventarisLabFarmasetikaController::class, 'create'])->name('tambahbarangkoorlabfarmasetika');
    Route::post('/koorlabfarmasi/labfarmasetika/tambahbarang', [InventarisLabFarmasetikaController::class, 'store'])->name('tambahbarangkoorlabfarmasetika.store');
    Route::get('/koorlabfarmasi/labfarmasetika/ubahbarang/{id}', [InventarisLabFarmasetikaController::class, 'edit'])->name('ubahbarangkoorlabfarmasetika');
    Route::post('/koorlabfarmasi/labfarmasetika/ubahbarang/{id}', [InventarisLabFarmasetikaController::class, 'update'])->name('updatebarangkoorlabfarmasetika');
    Route::get('/koorlabfarmasi/labfarmasetika/riwayatbarangmasuk', [BarangMasukFarmasetikaController::class, 'index'])->name('riwayatbarangmasukkoorlabfarmasetika');
    Route::get('/koorlabfarmasi/labfarmasetika/riwayatbarangkeluar', [BarangKeluarFarmasetikaController::class, 'index'])->name('riwayatbarangkeluarkoorlabfarmasetika');
    Route::get('/koorlabfarmasi/labfarmasetika/barangmasuk', [BarangMasukFarmasetikaController::class, 'tabel'])->name('barangmasukkoorlabfarmasetika');
    Route::get('/koorlabfarmasi/labfarmasetika/barangkeluar', [BarangKeluarFarmasetikaController::class, 'tabel'])->name('barangkeluarkoorlabfarmasetika');
    Route::post('/koorlabfarmasi/labfarmasetika/barangmasuk', [BarangMasukFarmasetikaController::class, 'store'])->name('barangmasukkoorlabfarmasetika.store');
    Route::post('/koorlabfarmasi/labfarmasetika/barangkeluar', [BarangKeluarFarmasetikaController::class, 'store'])->name('barangkeluarkoorlabfarmasetika.store');
    Route::get('/koorlabfarmasi/labfarmasetika/gambar/{id}', [InventarisLabFarmasetikaController::class, 'getGambar'])->name('get.gambar.invlabfarmasetika');

    Route::get('/koorlabfarmasi/labkimia/databarang', [InventarisLabKimiaController::class, 'index'])->name('databarangkoorlabfarmasikimia');
    Route::delete('/koorlabfarmasi/labkimia/databarang/{id}', [InventarisLabKimiaController::class, 'destroy'])->name('hapusbarangfarmasikimia');
    Route::get('/koorlabfarmasi/labkimia/tambahbarang', [InventarisLabKimiaController::class, 'create'])->name('tambahbarangkoorlabfarmasikimia');
    Route::post('/koorlabfarmasi/labkimia/tambahbarang', [InventarisLabKimiaController::class, 'store'])->name('tambahbarangkoorlabfarmasikimia.store');
    Route::get('/koorlabfarmasi/labkimia/ubahbarang/{id}', [InventarisLabKimiaController::class, 'edit'])->name('ubahbarangkoorlabfarmasikimia');
    Route::post('/koorlabfarmasi/labkimia/ubahbarang/{id}', [InventarisLabKimiaController::class, 'update'])->name('updatebarangkoorlabfarmasikimia');
    Route::get('/koorlabfarmasi/labkimia/riwayatbarangmasuk', [BarangMasukKimiaController::class, 'index'])->name('riwayatbarangmasukkoorlabfarmasikimia');
    Route::get('/koorlabfarmasi/labkimia/riwayatbarangkeluar', [BarangKeluarKimiaController::class, 'index'])->name('riwayatbarangkeluarkoorlabfarmasikimia');
    Route::get('/koorlabfarmasi/labkimia/barangmasuk', [BarangMasukKimiaController::class, 'tabel'])->name('barangmasukkoorlabfarmasikimia');
    Route::get('/koorlabfarmasi/labkimia/barangkeluar', [BarangKeluarKimiaController::class, 'tabel'])->name('barangkeluarkoorlabfarmasikimia');
    Route::post('/koorlabfarmasi/labkimia/barangmasuk', [BarangMasukKimiaController::class, 'store'])->name('barangmasukkoorlabfarmasikimia.store');
    Route::post('/koorlabfarmasi/labkimia/barangkeluar', [BarangKeluarKimiaController::class, 'store'])->name('barangkeluarkoorlabfarmasikimia.store');
    Route::get('/koorlabfarmasi/gambar/{id}', [InventarisLabKimiaController::class, 'getGambar'])->name('get.gambar.invlabfarmasikimia');

    Route::get('/koorlabfarmasi/labtekfarmasi/databarang', [InventarislabTekfarmasiController::class, 'index'])->name('databarangkoorlabtekfarmasi');
    Route::delete('/koorlabfarmasi/labtekfarmasi/databarang/{id}', [InventarislabTekfarmasiController::class, 'destroy'])->name('hapusbarangtekfarmasi');
    Route::get('/koorlabfarmasi/labtekfarmasi/tambahbarang', [InventarislabTekfarmasiController::class, 'create'])->name('tambahbarangkoorlabtekfarmasi');
    Route::post('/koorlabfarmasi/labtekfarmasi/tambahbarang', [InventarislabTekfarmasiController::class, 'store'])->name('tambahbarangkoorlabtekfarmasi.store');
    Route::get('/koorlabfarmasi/labtekfarmasi/ubahbarang/{id}', [InventarislabTekfarmasiController::class, 'edit'])->name('ubahbarangkoorlabtekfarmasi');
    Route::post('/koorlabfarmasi/labtekfarmasi/ubahbarang/{id}', [InventarislabTekfarmasiController::class, 'update'])->name('updatebarangkoorlabtekfarmasi');
    Route::get('/koorlabfarmasi/labtekfarmasi/riwayatbarangmasuk', [BarangMasukTekfarmasiController::class, 'index'])->name('riwayatbarangmasukkoorlabtekfarmasi');
    Route::get('/koorlabfarmasi/labtekfarmasi/riwayatbarangkeluar', [BarangKeluarTekfarmasiController::class, 'index'])->name('riwayatbarangkeluarkoorlabtekfarmasi');
    Route::get('/koorlabfarmasi/labtekfarmasi/barangmasuk', [BarangMasukTekfarmasiController::class, 'tabel'])->name('barangmasukkoorlabtekfarmasi');
    Route::get('/koorlabfarmasi/labtekfarmasi/barangkeluar', [BarangKeluarTekfarmasiController::class, 'tabel'])->name('barangkeluarkoorlabtekfarmasi');
    Route::post('/koorlabfarmasi/labtekfarmasi/barangmasuk', [BarangMasukTekfarmasiController::class, 'store'])->name('barangmasukkoorlabtekfarmasi.store');
    Route::post('/koorlabfarmasi/labtekfarmasi/barangkeluar', [BarangKeluarTekfarmasiController::class, 'store'])->name('barangkeluarkoorlabtekfarmasi.store');
    Route::get('/koorlabfarmasi/labtekfarmasi/gambar/{id}', [InventarislabTekfarmasiController::class, 'getGambar'])->name('get.gambar.invlabtekfarmasi');

    Route::get('/koorlabfarmasi/pengajuanbarang', [PengajuanBarangLabFarmasiController::class, 'index'])->name('pengajuanbarangkoorlabfarmasi');
    Route::get('/koorlabfarmasi/tambahpengajuanbarang', [PengajuanBarangLabFarmasiController::class, 'create'])->name('tambahpengajuankoorlabfarmasi');
    Route::post('/koorlabfarmasi/tambahpengajuanbarang', [PengajuanBarangLabFarmasiController::class, 'store'])->name('tambahpengajuankoorlabfarmasi.store');
    Route::get('/preview-surat/{id}', [PengajuanBarangLabFarmasiController::class, 'previewSurat'])->name('preview.surat.koorlabfarmasi');
    Route::get('/koorlabfarmasi/detailpengajuanbarang/{id}', [PengajuanBarangLabFarmasiController::class, 'show'])->name('detailpengajuankoorlabfarmasi');
    Route::get('/koorlabfarmasi/pengajuanbarang/edit/{id}', [PengajuanBarangLabFarmasiController::class, 'edit'])->name('editpengajuankoorlabfarmasi');
    Route::post('/koorlabfarmasi/pengajuanbarang/update/{id}', [PengajuanBarangLabFarmasiController::class, 'update'])->name('updatepengajuankoorlabfarmasi');
    Route::delete('/koorlabfarmasi/hapuspengajuan/{id}', [PengajuanBarangLabFarmasiController::class, 'destroy'])->name('hapuspengajuankoorlabfarmasi');

    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/koorlabfarmasi/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppkoorlabfarmasi');
    Route::post('/koorlabfarmasi/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name("update.picture.koorlabfarmasi");
    Route::get('/koorlabfarmasi/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpwkoorlabfarmasi');
    Route::post('/koorlabfarmasi/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.koorlabfarmasi');
});

Route::middleware(['auth', 'user.role:adminlabprodfarmasi', 'revalidate'])->group(function (){
    // Route::get('/adminlabfarmasi/dashboard', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.dashboard');
    // })->name('dashboardadminlabfarmasi');
    // Route::get('/ubahpwadminlabfarmasi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.ubahpassword');
    // })->name('ubahpwadminlabfarmasi');
    // Route::get('/ubahppadminlabfarmasi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.ubahprofil');
    // })->name('ubahppadminlabfarmasi');

    Route::get('/adminlabfarmasi/dashboard',[DashboardKoorAdminLabFarmasiController::class, 'index'])->name('dashboardadminlabfarmasi');
    Route::post('/adminlabfarmasi/dashboard', [DashboardKoorAdminLabFarmasiController::class, 'updateNotification'])->name('update.notification');
    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/adminlabfarmasi/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppadminlabfarmasi');
    Route::post('/adminlabfarmasi/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name('update.picture.adminlabfarmasi');
    Route::get('/adminlabfarmasi/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpwadminlabfarmasi');
    Route::post('/adminlabfarmasi/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.adminlabfarmasi');

    // Route::get('/databarangadminlabtekfarmasi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.databarang');
    // })->name('databarangadminlabtekfarmasi');
    // Route::get('/barangmasukadminlabtekfarmasi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.barangmasuk');
    // })->name('barangmasukadminlabtekfarmasi');
    // Route::get('/barangkeluaradminlabtekfarmasi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.barangkeluar');
    // })->name('barangkeluaradminlabtekfarmasi');
    // Route::get('/tambahbarangadminlabtekfarmasi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.tambahbarang');
    // })->name('tambahbarangadminlabtekfarmasi');
    // Route::get('/ubahbarangadminlabtekfarmasi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.ubahbarang');
    // })->name('ubahbarangadminlabtekfarmasi');
    Route::get('/adminlabfarmasi/labtekfarmasi/databarang', [InventarislabTekfarmasiController::class, 'index'])->name('databarangadminlabtekfarmasi');
    Route::delete('/adminlabfarmasi/labtekfarmasi/databarang/{id}', [InventarislabTekfarmasiController::class, 'destroy'])->name('hapusbarangtekfarmasi');
    Route::get('/adminlabfarmasi/labtekfarmasi/tambahbarang', [InventarislabTekfarmasiController::class, 'create'])->name('tambahbarangadminlabtekfarmasi');
    Route::post('/adminlabfarmasi/labtekfarmasi/tambahbarang', [InventarislabTekfarmasiController::class, 'store'])->name('tambahbarangadminlabtekfarmasi.store');
    Route::get('/adminlabfarmasi/labtekfarmasi/ubahbarang/{id}', [InventarislabTekfarmasiController::class, 'edit'])->name('ubahbarangadminlabtekfarmasi');
    Route::post('/adminlabfarmasi/labtekfarmasi/ubahbarang/{id}', [InventarislabTekfarmasiController::class, 'update'])->name('updatebarangadminlabtekfarmasi');
    Route::get('/adminlabfarmasi/labtekfarmasi/riwayatbarangmasuk', [BarangMasukTekfarmasiController::class, 'index'])->name('riwayatbarangmasukadminlabtekfarmasi');
    Route::get('/adminlabfarmasi/labtekfarmasi/riwayatbarangkeluar', [BarangKeluarTekfarmasiController::class, 'index'])->name('riwayatbarangkeluaradminlabtekfarmasi');
    Route::get('/adminlabfarmasi/labtekfarmasi/barangmasuk', [BarangMasukTekfarmasiController::class, 'tabel'])->name('barangmasukadminlabtekfarmasi');
    Route::get('/adminlabfarmasi/labtekfarmasi/barangkeluar', [BarangKeluarTekfarmasiController::class, 'tabel'])->name('barangkeluaradminlabtekfarmasi');
    Route::post('/adminlabfarmasi/labtekfarmasi/barangmasuk', [BarangMasukTekfarmasiController::class, 'store'])->name('barangmasukadminlabtekfarmasi.store');
    Route::post('/adminlabfarmasi/labtekfarmasi/barangkeluar', [BarangKeluarTekfarmasiController::class, 'store'])->name('barangkeluaradminlabtekfarmasi.store');
    Route::get('/adminlabfarmasi/labtekfarmasi/gambar/{id}', [InventarislabTekfarmasiController::class, 'getGambar'])->name('get.gambar.invlabtekfarmasi');


    // Route::get('/databarangadminlabfarmasetika', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.databarang');
    // })->name('databarangadminlabfarmasetika');
    // Route::get('/barangmasukadminlabfarmasetika', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.barangmasuk');
    // })->name('barangmasukadminlabfarmasetika');
    // Route::get('/barangkeluaradminlabfarmasetika', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.barangkeluar');
    // })->name('barangkeluaradminlabfarmasetika');
    // Route::get('/tambahbarangadminlabfarmasetika', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.tambahbarang');
    // })->name('tambahbarangadminlabfarmasetika');
    // Route::get('/ubahbarangadminlabfarmasetika', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.ubahbarang');
    // })->name('ubahbarangadminlabfarmasetika');
    Route::get('/adminlabfarmasi/labfarmasetika/databarang', [InventarisLabFarmasetikaController::class, 'index'])->name('databarangadminlabfarmasetika');
    Route::delete('/adminlabfarmasi/labfarmasetika/databarang/{id}', [InventarisLabFarmasetikaController::class, 'destroy'])->name('hapusbarangfarmasetika');
    Route::get('/adminlabfarmasi/labfarmasetika/tambahbarang', [InventarisLabFarmasetikaController::class, 'create'])->name('tambahbarangadminlabfarmasetika');
    Route::post('/adminlabfarmasi/labfarmasetika/tambahbarang', [InventarisLabFarmasetikaController::class, 'store'])->name('tambahbarangadminlabfarmasetika.store');
    Route::get('/adminlabfarmasi/labfarmasetika/ubahbarang/{id}', [InventarisLabFarmasetikaController::class, 'edit'])->name('ubahbarangadminlabfarmasetika');
    Route::post('/adminlabfarmasi/labfarmasetika/ubahbarang/{id}', [InventarisLabFarmasetikaController::class, 'update'])->name('updatebarangadminlabfarmasetika');
    Route::get('/adminlabfarmasi/labfarmasetika/riwayatbarangmasuk', [BarangMasukFarmasetikaController::class, 'index'])->name('riwayatbarangmasukadminlabfarmasetika');
    Route::get('/adminlabfarmasi/labfarmasetika/riwayatbarangkeluar', [BarangKeluarFarmasetikaController::class, 'index'])->name('riwayatbarangkeluaradminlabfarmasetika');
    Route::get('/adminlabfarmasi/labfarmasetika/barangmasuk', [BarangMasukFarmasetikaController::class, 'tabel'])->name('barangmasukadminlabfarmasetika');
    Route::get('/adminlabfarmasi/labfarmasetika/barangkeluar', [BarangKeluarFarmasetikaController::class, 'tabel'])->name('barangkeluaradminlabfarmasetika');
    Route::post('/adminlabfarmasi/labfarmasetika/barangmasuk', [BarangMasukFarmasetikaController::class, 'store'])->name('barangmasukadminlabfarmasetika.store');
    Route::post('/adminlabfarmasi/labfarmasetika/barangkeluar', [BarangKeluarFarmasetikaController::class, 'store'])->name('barangkeluaradminlabfarmasetika.store');
    Route::get('/adminlabfarmasi/labfarmasetika/gambar/{id}', [InventarisLabFarmasetikaController::class, 'getGambar'])->name('get.gambar.invlabfarmasetika');


    // Route::get('/databarangadminlabfarmasikimia', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.databarang');
    // })->name('databarangadminlabfarmasikimia');
    // Route::get('/barangmasukadminlabfarmasikimia', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.barangmasuk');
    // })->name('barangmasukadminlabfarmasikimia');
    // Route::get('/barangkeluaradminlabfarmasikimia', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.barangkeluar');
    // })->name('barangkeluaradminlabfarmasikimia');
    // Route::get('/tambahbarangadminlabfarmasikimia', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.tambahbarang');
    // })->name('tambahbarangadminlabfarmasikimia');
    // Route::get('/ubahbarangadminlabfarmasikimia', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmasikimia.ubahbarang');
    // })->name('ubahbarangadminlabfarmasikimia');
    Route::get('/adminlabfarmasi/labkimia/databarang', [InventarisLabKimiaController::class, 'index'])->name('databarangadminlabfarmasikimia');
    Route::delete('/adminlabfarmasi/labkimia/databarang/{id}', [InventarisLabKimiaController::class, 'destroy'])->name('hapusbarangfarmasikimia');
    Route::get('/adminlabfarmasi/labkimia/tambahbarang', [InventarisLabKimiaController::class, 'create'])->name('tambahbarangadminlabfarmasikimia');
    Route::post('/adminlabfarmasi/labkimia/tambahbarang', [InventarisLabKimiaController::class, 'store'])->name('tambahbarangadminlabfarmasikimia.store');
    Route::get('/adminlabfarmasi/labkimia/ubahbarang/{id}', [InventarisLabKimiaController::class, 'edit'])->name('ubahbarangadminlabfarmasikimia');
    Route::post('/adminlabfarmasi/labkimia/ubahbarang/{id}', [InventarisLabKimiaController::class, 'update'])->name('updatebarangadminlabfarmasikimia');
    Route::get('/adminlabfarmasi/labkimia/riwayatbarangmasuk', [BarangMasukKimiaController::class, 'index'])->name('riwayatbarangmasukadminlabfarmasikimia');
    Route::get('/adminlabfarmasi/labkimia/riwayatbarangkeluar', [BarangKeluarKimiaController::class, 'index'])->name('riwayatbarangkeluaradminlabfarmasikimia');
    Route::get('/adminlabfarmasi/labkimia/barangmasuk', [BarangMasukKimiaController::class, 'tabel'])->name('barangmasukadminlabfarmasikimia');
    Route::get('/adminlabfarmasi/labkimia/barangkeluar', [BarangKeluarKimiaController::class, 'tabel'])->name('barangkeluaradminlabfarmasikimia');
    Route::post('/adminlabfarmasi/labkimia/barangmasuk', [BarangMasukKimiaController::class, 'store'])->name('barangmasukadminlabfarmasikimia.store');
    Route::post('/adminlabfarmasi/labkimia/barangkeluar', [BarangKeluarKimiaController::class, 'store'])->name('barangkeluaradminlabfarmasikimia.store');
    Route::get('/adminlabfarmasi/gambar/{id}', [InventarisLabKimiaController::class, 'getGambar'])->name('get.gambar.invlabfarmasikimia');



    // Route::get('/databarangadminlabfarmakognosi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.databarang');
    // })->name('databarangadminlabfarmakognosi');
    // Route::get('/barangmasukadminlabfarmakognosi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.barangmasuk');
    // })->name('barangmasukadminlabfarmakognosi');
    // Route::get('/barangkeluaradminlabfarmakognosi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.barangkeluar');
    // })->name('barangkeluaradminlabfarmakognosi');
    // Route::get('/tambahbarangadminlabfarmakognosi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.tambahbarang');
    // })->name('tambahbarangadminlabfarmakognosi');
    // Route::get('/ubahbarangadminlabfarmakognosi', function () {
    //     return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.ubahbarang');
    // })->name('ubahbarangadminlabfarmakognosi');

    Route::get('/adminlabfarmasi/labfarmakognosi/databarang', [InventarislabFarmakognosiController::class, 'index'])->name('databarangadminlabfarmakognosi');
    Route::delete('/adminlabfarmasi/labfarmakognosi/databarang/{id}', [InventarislabFarmakognosiController::class, 'destroy'])->name('hapusbarangfarmakognosi');
    Route::get('/adminlabfarmasi/labfarmakognosi/tambahbarang', [InventarislabFarmakognosiController::class, 'create'])->name('tambahbarangadminlabfarmakognosi');
    Route::post('/adminlabfarmasi/labfarmakognosi/tambahbarang', [InventarislabFarmakognosiController::class, 'store'])->name('tambahbarangadminlabfarmakognosi.store');
    Route::get('/adminlabfarmasi/labfarmakognosi/ubahbarang/{id}', [InventarislabFarmakognosiController::class, 'edit'])->name('ubahbarangadminlabfarmakognosi');
    Route::post('/adminlabfarmasi/labfarmakognosi/ubahbarang/{id}', [InventarislabFarmakognosiController::class, 'update'])->name('updatebarangadminlabfarmakognosi');
    Route::get('/adminlabfarmasi/labfarmakognosi/gambar/{id}', [InventarislabFarmakognosiController::class, 'getGambar'])->name('get.gambar.invlabfarmakognosi');
    Route::get('/adminlabfarmasi/labfarmakognosi/riwayatbarangmasuk', [BarangMasukFarmakognosiController::class, 'index'])->name('riwayatbarangmasukadminlabfarmakognosi');
    Route::get('/adminlabfarmasi/labfarmakognosi/riwayatbarangkeluar', [BarangKeluarFarmakognosiController::class, 'index'])->name('riwayatbarangkeluaradminlabfarmakognosi');
    Route::get('/adminlabfarmasi/labfarmakognosi/barangmasuk', [BarangMasukFarmakognosiController::class, 'tabel'])->name('barangmasukadminlabfarmakognosi');
    Route::get('/adminlabfarmasi/labfarmakognosi/barangkeluar', [BarangKeluarFarmakognosiController::class, 'tabel'])->name('barangkeluaradminlabfarmakognosi');
    Route::post('/adminlabfarmasi/labfarmakognosi/barangmasuk', [BarangMasukFarmakognosiController::class, 'store'])->name('barangmasukadminlabfarmakognosi.store');
    Route::post('/adminlabfarmasi/labfarmakognosi/barangkeluar', [BarangKeluarFarmakognosiController::class, 'store'])->name('barangkeluaradminlabfarmakognosi.store');
});

Route::middleware(['auth', 'user.role:adminprodfarmasi', 'revalidate'])->group(function (){
    Route::get('/adminprodifarmasi/dashboard',[DashboardFarmasiController::class, 'index'])->name('dashboardadminprodifarmasi');
    Route::post('/adminprodifarmasi/dashboard', [DashboardFarmasiController::class, 'updateNotification'])->name('update.notification.adminprodifarmasi');
    Route::get('/adminprodifarmasi/databarang', [InventarisFarmasiController::class, 'index'])->name('databarangadminprodifarmasi');
    Route::delete('/adminprodifarmasi/databarang/{id}', [InventarisFarmasiController::class, 'destroy'])->name('hapusbarangfarmasi');
    Route::get('/adminprodifarmasi/tambahbarang', [InventarisFarmasiController::class, 'create'])->name('tambahbarangadminprodifarmasi');
    Route::post('/adminprodifarmasi/tambahbarang', [InventarisFarmasiController::class, 'store'])->name('tambahbarangadminprodifarmasi.store');
    Route::get('/adminprodifarmasi/ubahbarang/{id}', [InventarisFarmasiController::class, 'edit'])->name('ubahbarangadminprodifarmasi');
    Route::post('/adminprodifarmasi/ubahbarang/{id}', [InventarisFarmasiController::class, 'update'])->name('updatebarangadminprodifarmasi');
    Route::get('/adminprodifarmasi/gambar/{id}', [InventarisFarmasiController::class, 'getGambar'])->name('get.gambar.invfarmasi');
    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/adminprodifarmasi/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppadminprodifarmasi');
    Route::post('/adminprodifarmasi/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name("update.picture.adminprodifarmasi");
    Route::get('/adminprodifarmasi/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpwadminprodifarmasi');
    Route::post('/adminprodifarmasi/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.adminprodifarmasi');
    Route::get('/adminprodifarmasi/riwayatbarangmasuk', [BarangMasukFarmasiController::class, 'index'])->name('riwayatbarangmasukadminprodifarmasi');
    Route::get('/adminprodifarmasi/riwayatbarangkeluar', [BarangKeluarFarmasiController::class, 'index'])->name('riwayatbarangkeluaradminprodifarmasi');
    Route::get('/adminprodifarmasi/barangmasuk', [BarangMasukFarmasiController::class, 'tabel'])->name('barangmasukadminprodifarmasi');
    Route::get('/adminprodifarmasi/barangkeluar', [BarangKeluarFarmasiController::class, 'tabel'])->name('barangkeluaradminprodifarmasi');
    Route::post('/adminprodifarmasi/barangmasuk', [BarangMasukFarmasiController::class, 'store'])->name('barangmasukadminprodifarmasi.store');
    Route::post('/adminprodifarmasi/barangkeluar', [BarangKeluarFarmasiController::class, 'store'])->name('barangkeluaradminprodifarmasi.store');
});