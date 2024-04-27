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
use App\Http\Controllers\KoorAdminLabFarmasi\PengajuanBarangLabFarmasiController;
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
    Route::get('/wakildirektur/get-barcode/{id}', [InventarisLabfarmakognosiController::class, 'getBarcode'])->name('get.barcode.invlabfarmakognosi');


});

Route::middleware(['auth', 'user.role:koorlabprodfarmasi', 'revalidate'])->group(function (){
    Route::get('/koorlabfarmasi/dashboard',[DashboardKoorAdminLabFarmasiController::class, 'index'])->name('dashboardkoorlabfarmasi');
    // Route::get('/koorlabfarmasi/notif',[DashboardKoorAdminLabFarmasiController::class, 'notifservice'])->name('dashboardkoorlabfarmasi');
    Route::post('/koorlabfarmasi/dashboard', [DashboardKoorAdminLabFarmasiController::class, 'updateNotification'])->name('update.notification');
    Route::get('/koorlabfarmasi/labfarmakognosi/databarang', [InventarislabFarmakognosiController::class, 'index'])->name('databarangkoorlabfarmakognosi');
    Route::delete('/koorlabfarmasi/labfarmakognosi/databarang/{id}', [InventarislabFarmakognosiController::class, 'destroy'])->name('hapusbarangfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/tambahbarang', [InventarislabFarmakognosiController::class, 'create'])->name('tambahbarangkoorlabfarmakognosi');
    Route::post('/koorlabfarmasi/labfarmakognosi/tambahbarang', [InventarislabFarmakognosiController::class, 'store'])->name('tambahbarangkoorlabfarmakognosi.store');
    // Route::get('/koorlabfarmasi/labfarmakognosi/kurangibarang', [InventarislabFarmakognosiController::class, 'create'])->name('kurangibarangkoorlabfarmakognosi');
    // Route::post('/koorlabfarmasi/labfarmakognosi/kurangibarang', [InventarislabFarmakognosiController::class, 'store'])->name('kurangibarangkoorlabfarmakognosi.store');
    Route::get('/koorlabfarmasi/labfarmakognosi/ubahbarang/{id}', [InventarislabFarmakognosiController::class, 'edit'])->name('ubahbarangkoorlabfarmakognosi');
    Route::post('/koorlabfarmasi/labfarmakognosi/ubahbarang/{id}', [InventarislabFarmakognosiController::class, 'update'])->name('updatebarangkoorlabfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/riwayatbarangmasuk', [BarangMasukFarmakognosiController::class, 'index'])->name('riwayatbarangmasukkoorlabfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/riwayatbarangkeluar', [BarangKeluarFarmakognosiController::class, 'index'])->name('riwayatbarangkeluarkoorlabfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/barangmasuk', [BarangMasukFarmakognosiController::class, 'tabel'])->name('barangmasukkoorlabfarmakognosi');
    Route::get('/koorlabfarmasi/labfarmakognosi/barangkeluar', [BarangKeluarFarmakognosiController::class, 'tabel'])->name('barangkeluarkoorlabfarmakognosi');
    Route::post('/koorlabfarmasi/labfarmakognosi/barangmasuk', [BarangMasukFarmakognosiController::class, 'store'])->name('barangmasukkoorlabfarmakognosi.store');
    Route::post('/koorlabfarmasi/labfarmakognosi/barangkeluar', [BarangKeluarFarmakognosiController::class, 'store'])->name('barangkeluarkoorlabfarmakognosi.store');
    Route::get('/koorlabfarmasi/pengajuanbarang', [PengajuanBarangLabFarmasiController::class, 'index'])->name('pengajuanbarangkoorlabfarmasi');
    Route::get('/koorlabfarmasi/tambahpengajuanbarang', [PengajuanBarangLabFarmasiController::class, 'create'])->name('tambahpengajuankoorlabfarmasi');
    Route::post('/koorlabfarmasi/tambahpengajuanbarang', [PengajuanBarangLabFarmasiController::class, 'store'])->name('tambahpengajuankoorlabfarmasi.store');
    Route::get('/preview-surat/{id}', [PengajuanBarangLabFarmasiController::class, 'previewSurat'])->name('preview.surat.koorlabfarmasi');
    Route::get('/koorlabfarmasi/detailpengajuanbarang/{id}', [PengajuanBarangLabFarmasiController::class, 'show'])->name('detailpengajuankoorlabfarmasi');
    Route::get('/koorlabfarmasi/pengajuanbarang/edit/{id}', [PengajuanBarangLabFarmasiController::class, 'edit'])->name('editpengajuankoorlabfarmasi');
    Route::post('/koorlabfarmasi/pengajuanbarang/update/{id}', [PengajuanBarangLabFarmasiController::class, 'update'])->name('updatepengajuankoorlabfarmasi');
    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/koorlabfarmasi/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppkoorlabfarmasi');
    Route::post('/koorlabfarmasi/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name("update.picture.koorlabfarmasi");
    Route::get('/koorlabfarmasi/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpwkoorlabfarmasi');
    Route::post('/koorlabfarmasi/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.koorlabfarmasi');
    Route::delete('/koorlabfarmasi/hapuspengajuan/{id}', [PengajuanBarangLabFarmasiController::class, 'destroy'])->name('hapuspengajuankoorlabfarmasi');
    Route::get('/koorlabfarmasi/gambar/{id}', [InventarislabFarmakognosiController::class, 'getGambar'])->name('get.gambar.invlabfarmakognosi');



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
});

Route::middleware(['auth', 'user.role:adminlabprodfarmasi', 'revalidate'])->group(function (){
    Route::get('/adminlabfarmasi/dashboard', function () {
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


});

Route::middleware(['auth', 'user.role:adminprodfarmasi', 'revalidate'])->group(function (){
    Route::get('/adminprodifarmasi/dashboard', function () {
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

});