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

use App\Http\Controllers\AdminProdiAnkes\DashboardAnkesController;
use App\Http\Controllers\AdminProdiAnkes\BarangMasukAnkesController;
use App\Http\Controllers\AdminProdiAnkes\BarangKeluarAnkesController;
use App\Http\Controllers\AdminProdiAnkes\InventarisAnkesController;

use App\Http\Controllers\KoorAdminLabAnkes\DashboardKoorAdminLabAnkesController;
use App\Http\Controllers\KoorAdminLabAnkes\BarangMasukAnkeskimiaController;
use App\Http\Controllers\KoorAdminLabAnkes\BarangKeluarAnkeskimiaController;
use App\Http\Controllers\KoorAdminLabAnkes\InventarisLabAnkeskimiaController;
use App\Http\Controllers\KoorAdminLabAnkes\BarangMasukMedisController;
use App\Http\Controllers\KoorAdminLabAnkes\BarangKeluarMedisController;
use App\Http\Controllers\KoorAdminLabAnkes\InventarisLabMedisController;
use App\Http\Controllers\KoorAdminLabAnkes\BarangMasukMikroController;
use App\Http\Controllers\KoorAdminLabAnkes\BarangKeluarMikroController;
use App\Http\Controllers\KoorAdminLabAnkes\InventarisLabMikroController;
use App\Http\Controllers\KoorAdminLabAnkes\BarangMasukSitohistoController;
use App\Http\Controllers\KoorAdminLabAnkes\BarangKeluarSitohistoController;
use App\Http\Controllers\KoorAdminLabAnkes\InventarisLabSitohistoController;
use App\Http\Controllers\KoorAdminLabAnkes\PengajuanBarangLabAnkesController;

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
    Route::get('/superadmin/pengajuanbarang', [PengajuanWadirController::class, 'getpengajuan'])->name('pengajuanbarangsuperadmin');
    Route::put('/superadmin/pengajuanbarang/{id}', [PengajuanWadirController::class, 'updateStatus'])->name('updatestatuskoorlabfarmasisuperadmin');
    Route::get('/superadmin/detailpengajuanbarang/{id}', [PengajuanWadirController::class, 'detailPengajuanKoorLabFarmasi'])->name('detailpengajuansuperadmin');
    Route::get('/preview-surat-superadmin/{id}', [PengajuanWadirController::class, 'previewSurat'])->name('preview.suratsuperadmin');
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
    Route::get('/wakildirektur/detailpengajuanbarang/{id}', [PengajuanWadirController::class, 'detailPengajuanKoorLabFarmasi'])->name('detailpengajuanwadir');
    Route::get('/preview-surat-wadir/{id}', [PengajuanWadirController::class, 'previewSurat'])->name('preview.suratwadir');
    Route::get('/wakildirektur/laporanlaboratorium',[LaporanWadirController::class, 'laporanlab'])->name('laporanlabwadir');
    Route::get('/wakildirektur/laporanprodi',[LaporanWadirController::class, 'laporanprodi'])->name('laporanprodiwadir');
    Route::post('/wakildirektur/laporanlaboratorium', [LaporanWadirController::class, 'previewLaporan'])->name('tampilkanLaporan');
    Route::post('/wakildirektur/laporanprodi', [LaporanWadirController::class, 'previewLaporanProdi'])->name('tampilkanLaporanProdi');
    Route::post('/wakildirektur/laporandatabarang/laboratorium', [LaporanWadirController::class, 'cetakSemuaData'])->name('tampilkanLaporanDBLab');
    Route::post('/wakildirektur/laporandatabarang/prodi', [LaporanWadirController::class, 'cetakSemuaDataProdi'])->name('tampilkanLaporanDBProdi');
    Route::get('/wakildirektur/get-barcode/{id}', [InventarisLabfarmakognosiController::class, 'getBarcode'])->name('get.barcode.invlabfarmakognosi');


});

Route::middleware(['auth', 'user.role:koorlabprodfarmasi', 'revalidate'])->group(function (){
    Route::get('/koorlabfarmasi/dashboard',[DashboardKoorAdminLabFarmasiController::class, 'index'])->name('dashboardkoorlabfarmasi');
    Route::post('/koorlabfarmasi/dashboard/farmakognosi', [DashboardKoorAdminLabFarmasiController::class, 'updatefarmakognosi'])->name('reminder.updatefarmakognosi');
    Route::post('/koorlabfarmasi/dashboard/farmasetika', [DashboardKoorAdminLabFarmasiController::class, 'updatefarmasetika'])->name('reminder.updatefarmasetika');
    Route::post('/koorlabfarmasi/dashboard/kimia', [DashboardKoorAdminLabFarmasiController::class, 'updatekimia'])->name('reminder.updatekimia');
    Route::post('/koorlabfarmasi/dashboard/tekfarmasi', [DashboardKoorAdminLabFarmasiController::class, 'updatetekfarmasi'])->name('reminder.updatetekfarmasi');
    Route::get('/koorlabfarmasi/riwayatservice/farmakognosi', [DashboardKoorAdminLabFarmasiController::class, 'historyfarmakognosi'])->name('riwayat.farmakognosi');
    Route::get('/koorlabfarmasi/riwayatservice/farmasetika', [DashboardKoorAdminLabFarmasiController::class, 'historyfarmasetika'])->name('riwayat.farmasetika');
    Route::get('/koorlabfarmasi/riwayatservice/kimia', [DashboardKoorAdminLabFarmasiController::class, 'historykimia'])->name('riwayat.kimia');
    Route::get('/koorlabfarmasi/riwayatservice/tekfarmasi', [DashboardKoorAdminLabFarmasiController::class, 'historytekfarmasi'])->name('riwayat.tekfarmasi');

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
    Route::get('/preview-suratfarmasi/{id}', [PengajuanBarangLabFarmasiController::class, 'previewSurat'])->name('preview.surat.koorlabfarmasi');
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
    Route::get('/adminlabfarmasi/dashboard',[DashboardKoorAdminLabFarmasiController::class, 'index'])->name('dashboardadminlabfarmasi');
    Route::post('/adminlabfarmasi/dashboard/farmakognosi', [DashboardKoorAdminLabFarmasiController::class, 'updatefarmakognosi'])->name('reminder.updatefarmakognosi.adminlabfarmasi');
    Route::post('/adminlabfarmasi/dashboard/farmasetika', [DashboardKoorAdminLabFarmasiController::class, 'updatefarmasetika'])->name('reminder.updatefarmasetika.adminlabfarmasi');
    Route::post('/adminlabfarmasi/dashboard/kimia', [DashboardKoorAdminLabFarmasiController::class, 'updatekimia'])->name('reminder.updatekimia.adminlabfarmasi');
    Route::post('/adminlabfarmasi/dashboard/tekfarmasi', [DashboardKoorAdminLabFarmasiController::class, 'updatetekfarmasi'])->name('reminder.updatetekfarmasi.adminlabfarmasi');
    Route::get('/adminlabfarmasi/riwayatservice/farmakognosi', [DashboardKoorAdminLabFarmasiController::class, 'historyfarmakognosi'])->name('riwayat.farmakognosi.adminlabfarmasi');
    Route::get('/adminlabfarmasi/riwayatservice/farmasetika', [DashboardKoorAdminLabFarmasiController::class, 'historyfarmasetika'])->name('riwayat.farmasetika.adminlabfarmasi');
    Route::get('/adminlabfarmasi/riwayatservice/kimia', [DashboardKoorAdminLabFarmasiController::class, 'historykimia'])->name('riwayat.kimia.adminlabfarmasi');
    Route::get('/adminlabfarmasi/riwayatservice/tekfarmasi', [DashboardKoorAdminLabFarmasiController::class, 'historytekfarmasi'])->name('riwayat.tekfarmasi.adminlabfarmasi');

    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/adminlabfarmasi/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppadminlabfarmasi');
    Route::post('/adminlabfarmasi/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name('update.picture.adminlabfarmasi');
    Route::get('/adminlabfarmasi/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpwadminlabfarmasi');
    Route::post('/adminlabfarmasi/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.adminlabfarmasi');

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
    Route::get('/adminprodifarmasi/riwayat', [DashboardFarmasiController::class, 'getRiwayatFarmasi'])->name('riwayat.adminprodifarmasi');
    Route::post('/adminprodifarmasi/dashboard', [DashboardFarmasiController::class, 'update'])->name('reminder.update.adminprodifarmasi');

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

Route::middleware(['auth', 'user.role:koorlabprodankes', 'revalidate'])->group(function (){
    Route::get('/koorlabankes/dashboard',[DashboardKoorAdminLabAnkesController::class, 'index'])->name('dashboardkoorlabankes');
    Route::post('/koorlabankes/dashboard/ankeskimia', [DashboardKoorAdminLabAnkesController::class, 'updateankeskimia'])->name('reminder.updateankeskimia');
    Route::post('/koorlabankes/dashboard/medis', [DashboardKoorAdminLabAnkesController::class, 'updatemedis'])->name('reminder.updatemedis');
    Route::post('/koorlabankes/dashboard/mikro', [DashboardKoorAdminLabAnkesController::class, 'updatemikro'])->name('reminder.updatemikro');
    Route::post('/koorlabankes/dashboard/sitohisto', [DashboardKoorAdminLabAnkesController::class, 'updatesitohisto'])->name('reminder.updatesitohisto');
    Route::get('/koorlabankes/riwayatservice/ankeskimia', [DashboardKoorAdminLabAnkesController::class, 'historyankeskimia'])->name('riwayat.ankeskimia');
    Route::get('/koorlabankes/riwayatservice/medis', [DashboardKoorAdminLabAnkesController::class, 'historymedis'])->name('riwayat.medis');
    Route::get('/koorlabankes/riwayatservice/mikro', [DashboardKoorAdminLabAnkesController::class, 'historymikro'])->name('riwayat.mikro');
    Route::get('/koorlabankes/riwayatservice/sitohisto', [DashboardKoorAdminLabAnkesController::class, 'historysitohisto'])->name('riwayat.sitohisto');

    Route::get('/koorlabankes/labsitohisto/databarang', [InventarisLabSitohistoController::class, 'index'])->name('databarangkoorlabsitohisto');
    Route::delete('/koorlabankes/labsitohisto/databarang/{id}', [InventarisLabSitohistoController::class, 'destroy'])->name('hapusbarangsitohisto');
    Route::get('/koorlabankes/labsitohisto/tambahbarang', [InventarisLabSitohistoController::class, 'create'])->name('tambahbarangkoorlabsitohisto');
    Route::post('/koorlabankes/labsitohisto/tambahbarang', [InventarisLabSitohistoController::class, 'store'])->name('tambahbarangkoorlabsitohisto.store');
    Route::get('/koorlabankes/labsitohisto/ubahbarang/{id}', [InventarisLabSitohistoController::class, 'edit'])->name('ubahbarangkoorlabsitohisto');
    Route::post('/koorlabankes/labsitohisto/ubahbarang/{id}', [InventarisLabSitohistoController::class, 'update'])->name('updatebarangkoorlabsitohisto');
    Route::get('/koorlabankes/labsitohisto/gambar/{id}', [InventarisLabSitohistoController::class, 'getGambar'])->name('get.gambar.invlabsitohisto');
    Route::get('/koorlabankes/labsitohisto/riwayatbarangmasuk', [BarangMasukSitohistoController::class, 'index'])->name('riwayatbarangmasukkoorlabsitohisto');
    Route::get('/koorlabankes/labsitohisto/riwayatbarangkeluar', [BarangKeluarSitohistoController::class, 'index'])->name('riwayatbarangkeluarkoorlabsitohisto');
    Route::get('/koorlabankes/labsitohisto/barangmasuk', [BarangMasukSitohistoController::class, 'tabel'])->name('barangmasukkoorlabsitohisto');
    Route::get('/koorlabankes/labsitohisto/barangkeluar', [BarangKeluarSitohistoController::class, 'tabel'])->name('barangkeluarkoorlabsitohisto');
    Route::post('/koorlabankes/labsitohisto/barangmasuk', [BarangMasukSitohistoController::class, 'store'])->name('barangmasukkoorlabsitohisto.store');
    Route::post('/koorlabankes/labsitohisto/barangkeluar', [BarangKeluarSitohistoController::class, 'store'])->name('barangkeluarkoorlabsitohisto.store');

    Route::get('/koorlabankes/labmikro/databarang', [InventarisLabMikroController::class, 'index'])->name('databarangkoorlabmikro');
    Route::delete('/koorlabankes/labmikro/databarang/{id}', [InventarisLabMikroController::class, 'destroy'])->name('hapusbarangmikro');
    Route::get('/koorlabankes/labmikro/tambahbarang', [InventarisLabMikroController::class, 'create'])->name('tambahbarangkoorlabmikro');
    Route::post('/koorlabankes/labmikro/tambahbarang', [InventarisLabMikroController::class, 'store'])->name('tambahbarangkoorlabmikro.store');
    Route::get('/koorlabankes/labmikro/ubahbarang/{id}', [InventarisLabMikroController::class, 'edit'])->name('ubahbarangkoorlabmikro');
    Route::post('/koorlabankes/labmikro/ubahbarang/{id}', [InventarisLabMikroController::class, 'update'])->name('updatebarangkoorlabmikro');
    Route::get('/koorlabankes/labmikro/riwayatbarangmasuk', [BarangMasukMikroController::class, 'index'])->name('riwayatbarangmasukkoorlabmikro');
    Route::get('/koorlabankes/labmikro/riwayatbarangkeluar', [BarangKeluarMikroController::class, 'index'])->name('riwayatbarangkeluarkoorlabmikro');
    Route::get('/koorlabankes/labmikro/barangmasuk', [BarangMasukMikroController::class, 'tabel'])->name('barangmasukkoorlabmikro');
    Route::get('/koorlabankes/labmikro/barangkeluar', [BarangKeluarMikroController::class, 'tabel'])->name('barangkeluarkoorlabmikro');
    Route::post('/koorlabankes/labmikro/barangmasuk', [BarangMasukMikroController::class, 'store'])->name('barangmasukkoorlabmikro.store');
    Route::post('/koorlabankes/labmikro/barangkeluar', [BarangKeluarMikroController::class, 'store'])->name('barangkeluarkoorlabmikro.store');
    Route::get('/koorlabankes/labmikro/gambar/{id}', [InventarisLabMikroController::class, 'getGambar'])->name('get.gambar.invlabmikro');

    Route::get('/koorlabankes/labankeskimia/databarang', [InventarisLabAnkeskimiaController::class, 'index'])->name('databarangkoorlabankeskimia');
    Route::delete('/koorlabankes/labankeskimia/databarang/{id}', [InventarisLabAnkeskimiaController::class, 'destroy'])->name('hapusbarangankeskimia');
    Route::get('/koorlabankes/labankeskimia/tambahbarang', [InventarisLabAnkeskimiaController::class, 'create'])->name('tambahbarangkoorlabankeskimia');
    Route::post('/koorlabankes/labankeskimia/tambahbarang', [InventarisLabAnkeskimiaController::class, 'store'])->name('tambahbarangkoorlabankeskimia.store');
    Route::get('/koorlabankes/labankeskimia/ubahbarang/{id}', [InventarisLabAnkeskimiaController::class, 'edit'])->name('ubahbarangkoorlabankeskimia');
    Route::post('/koorlabankes/labankeskimia/ubahbarang/{id}', [InventarisLabAnkeskimiaController::class, 'update'])->name('updatebarangkoorlabankeskimia');
    Route::get('/koorlabankes/labankeskimia/riwayatbarangmasuk', [BarangMasukAnkeskimiaController::class, 'index'])->name('riwayatbarangmasukkoorlabankeskimia');
    Route::get('/koorlabankes/labankeskimia/riwayatbarangkeluar', [BarangKeluarAnkeskimiaController::class, 'index'])->name('riwayatbarangkeluarkoorlabankeskimia');
    Route::get('/koorlabankes/labankeskimia/barangmasuk', [BarangMasukAnkeskimiaController::class, 'tabel'])->name('barangmasukkoorlabankeskimia');
    Route::get('/koorlabankes/labankeskimia/barangkeluar', [BarangKeluarAnkeskimiaController::class, 'tabel'])->name('barangkeluarkoorlabankeskimia');
    Route::post('/koorlabankes/labankeskimia/barangmasuk', [BarangMasukAnkeskimiaController::class, 'store'])->name('barangmasukkoorlabankeskimia.store');
    Route::post('/koorlabankes/labankeskimia/barangkeluar', [BarangKeluarAnkeskimiaController::class, 'store'])->name('barangkeluarkoorlabankeskimia.store');
    Route::get('/koorlabankes/gambar/{id}', [InventarisLabAnkeskimiaController::class, 'getGambar'])->name('get.gambar.invlabankeskimia');

    Route::get('/koorlabankes/labmedis/databarang', [InventarisLabMedisController::class, 'index'])->name('databarangkoorlabmedis');
    Route::delete('/koorlabankes/labmedis/databarang/{id}', [InventarisLabMedisController::class, 'destroy'])->name('hapusbarangmedis');
    Route::get('/koorlabankes/labmedis/tambahbarang', [InventarisLabMedisController::class, 'create'])->name('tambahbarangkoorlabmedis');
    Route::post('/koorlabankes/labmedis/tambahbarang', [InventarisLabMedisController::class, 'store'])->name('tambahbarangkoorlabmedis.store');
    Route::get('/koorlabankes/labmedis/ubahbarang/{id}', [InventarisLabMedisController::class, 'edit'])->name('ubahbarangkoorlabmedis');
    Route::post('/koorlabankes/labmedis/ubahbarang/{id}', [InventarisLabMedisController::class, 'update'])->name('updatebarangkoorlabmedis');
    Route::get('/koorlabankes/labmedis/riwayatbarangmasuk', [BarangMasukMedisController::class, 'index'])->name('riwayatbarangmasukkoorlabmedis');
    Route::get('/koorlabankes/labmedis/riwayatbarangkeluar', [BarangKeluarMedisController::class, 'index'])->name('riwayatbarangkeluarkoorlabmedis');
    Route::get('/koorlabankes/labmedis/barangmasuk', [BarangMasukMedisController::class, 'tabel'])->name('barangmasukkoorlabmedis');
    Route::get('/koorlabankes/labmedis/barangkeluar', [BarangKeluarMedisController::class, 'tabel'])->name('barangkeluarkoorlabmedis');
    Route::post('/koorlabankes/labmedis/barangmasuk', [BarangMasukMedisController::class, 'store'])->name('barangmasukkoorlabmedis.store');
    Route::post('/koorlabankes/labmedis/barangkeluar', [BarangKeluarMedisController::class, 'store'])->name('barangkeluarkoorlabmedis.store');
    Route::get('/koorlabankes/labmedis/gambar/{id}', [InventarisLabMedisController::class, 'getGambar'])->name('get.gambar.invlabmedis');

    Route::get('/koorlabankes/pengajuanbarang', [PengajuanBarangLabAnkesController::class, 'index'])->name('pengajuanbarangkoorlabankes');
    Route::get('/koorlabankes/tambahpengajuanbarang', [PengajuanBarangLabAnkesController::class, 'create'])->name('tambahpengajuankoorlabankes');
    Route::post('/koorlabankes/tambahpengajuanbarang', [PengajuanBarangLabAnkesController::class, 'store'])->name('tambahpengajuankoorlabankes.store');
    Route::get('/preview-suratankes/{id}', [PengajuanBarangLabAnkesController::class, 'previewSurat'])->name('preview.surat.koorlabankes');
    Route::get('/koorlabankes/detailpengajuanbarang/{id}', [PengajuanBarangLabAnkesController::class, 'show'])->name('detailpengajuankoorlabankes');
    Route::get('/koorlabankes/pengajuanbarang/edit/{id}', [PengajuanBarangLabAnkesController::class, 'edit'])->name('editpengajuankoorlabankes');
    Route::post('/koorlabankes/pengajuanbarang/update/{id}', [PengajuanBarangLabAnkesController::class, 'update'])->name('updatepengajuankoorlabankes');
    Route::delete('/koorlabankes/hapuspengajuan/{id}', [PengajuanBarangLabAnkesController::class, 'destroy'])->name('hapuspengajuankoorlabankes');

    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/koorlabankes/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppkoorlabankes');
    Route::post('/koorlabankes/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name("update.picture.koorlabankes");
    Route::get('/koorlabankes/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpwkoorlabankes');
    Route::post('/koorlabankes/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.koorlabankes');
});

Route::middleware(['auth', 'user.role:adminlabprodankes', 'revalidate'])->group(function (){
    Route::get('/adminlabankes/dashboard',[DashboardKoorAdminLabAnkesController::class, 'index'])->name('dashboardadminlabankes');
    Route::post('/adminlabankes/dashboard/ankeskimia', [DashboardKoorAdminLabAnkesController::class, 'updateankeskimia'])->name('reminder.updateankeskimia.adminlabankes');
    Route::post('/adminlabankes/dashboard/medis', [DashboardKoorAdminLabAnkesController::class, 'updatemedis'])->name('reminder.updatemedis.adminlabankes');
    Route::post('/adminlabankes/dashboard/mikro', [DashboardKoorAdminLabAnkesController::class, 'updatemikro'])->name('reminder.updatemikro.adminlabankes');
    Route::post('/adminlabankes/dashboard/sitohisto', [DashboardKoorAdminLabAnkesController::class, 'updatesitohisto'])->name('reminder.updatesitohisto.adminlabankes');
    Route::get('/adminlabankes/riwayatservice/ankeskimia', [DashboardKoorAdminLabAnkesController::class, 'historyankeskimia'])->name('riwayat.ankeskimia.adminlabankes');
    Route::get('/adminlabankes/riwayatservice/medis', [DashboardKoorAdminLabAnkesController::class, 'historymedis'])->name('riwayat.medis.adminlabankes');
    Route::get('/adminlabankes/riwayatservice/mikro', [DashboardKoorAdminLabAnkesController::class, 'historymikro'])->name('riwayat.mikro.adminlabankes');
    Route::get('/adminlabankes/riwayatservice/sitohisto', [DashboardKoorAdminLabAnkesController::class, 'historysitohisto'])->name('riwayat.sitohisto.adminlabankes');

    Route::get('/adminlabankes/labsitohisto/databarang', [InventarisLabSitohistoController::class, 'index'])->name('databarangadminlabsitohisto');
    Route::delete('/adminlabankes/labsitohisto/databarang/{id}', [InventarisLabSitohistoController::class, 'destroy'])->name('hapusbarangsitohisto');
    Route::get('/adminlabankes/labsitohisto/tambahbarang', [InventarisLabSitohistoController::class, 'create'])->name('tambahbarangadminlabsitohisto');
    Route::post('/adminlabankes/labsitohisto/tambahbarang', [InventarisLabSitohistoController::class, 'store'])->name('tambahbarangadminlabsitohisto.store');
    Route::get('/adminlabankes/labsitohisto/ubahbarang/{id}', [InventarisLabSitohistoController::class, 'edit'])->name('ubahbarangadminlabsitohisto');
    Route::post('/adminlabankes/labsitohisto/ubahbarang/{id}', [InventarisLabSitohistoController::class, 'update'])->name('updatebarangadminlabsitohisto');
    Route::get('/adminlabankes/labsitohisto/gambar/{id}', [InventarisLabSitohistoController::class, 'getGambar'])->name('get.gambar.invlabsitohisto');
    Route::get('/adminlabankes/labsitohisto/riwayatbarangmasuk', [BarangMasukSitohistoController::class, 'index'])->name('riwayatbarangmasukadminlabsitohisto');
    Route::get('/adminlabankes/labsitohisto/riwayatbarangkeluar', [BarangKeluarSitohistoController::class, 'index'])->name('riwayatbarangkeluaradminlabsitohisto');
    Route::get('/adminlabankes/labsitohisto/barangmasuk', [BarangMasukSitohistoController::class, 'tabel'])->name('barangmasukadminlabsitohisto');
    Route::get('/adminlabankes/labsitohisto/barangkeluar', [BarangKeluarSitohistoController::class, 'tabel'])->name('barangkeluaradminlabsitohisto');
    Route::post('/adminlabankes/labsitohisto/barangmasuk', [BarangMasukSitohistoController::class, 'store'])->name('barangmasukadminlabsitohisto.store');
    Route::post('/adminlabankes/labsitohisto/barangkeluar', [BarangKeluarSitohistoController::class, 'store'])->name('barangkeluaradminlabsitohisto.store');

    Route::get('/adminlabankes/labmikro/databarang', [InventarisLabMikroController::class, 'index'])->name('databarangadminlabmikro');
    Route::delete('/adminlabankes/labmikro/databarang/{id}', [InventarisLabMikroController::class, 'destroy'])->name('hapusbarangmikro');
    Route::get('/adminlabankes/labmikro/tambahbarang', [InventarisLabMikroController::class, 'create'])->name('tambahbarangadminlabmikro');
    Route::post('/adminlabankes/labmikro/tambahbarang', [InventarisLabMikroController::class, 'store'])->name('tambahbarangadminlabmikro.store');
    Route::get('/adminlabankes/labmikro/ubahbarang/{id}', [InventarisLabMikroController::class, 'edit'])->name('ubahbarangadminlabmikro');
    Route::post('/adminlabankes/labmikro/ubahbarang/{id}', [InventarisLabMikroController::class, 'update'])->name('updatebarangadminlabmikro');
    Route::get('/adminlabankes/labmikro/riwayatbarangmasuk', [BarangMasukMikroController::class, 'index'])->name('riwayatbarangmasukadminlabmikro');
    Route::get('/adminlabankes/labmikro/riwayatbarangkeluar', [BarangKeluarMikroController::class, 'index'])->name('riwayatbarangkeluaradminlabmikro');
    Route::get('/adminlabankes/labmikro/barangmasuk', [BarangMasukMikroController::class, 'tabel'])->name('barangmasukadminlabmikro');
    Route::get('/adminlabankes/labmikro/barangkeluar', [BarangKeluarMikroController::class, 'tabel'])->name('barangkeluaradminlabmikro');
    Route::post('/adminlabankes/labmikro/barangmasuk', [BarangMasukMikroController::class, 'store'])->name('barangmasukadminlabmikro.store');
    Route::post('/adminlabankes/labmikro/barangkeluar', [BarangKeluarMikroController::class, 'store'])->name('barangkeluaradminlabmikro.store');
    Route::get('/adminlabankes/labmikro/gambar/{id}', [InventarisLabMikroController::class, 'getGambar'])->name('get.gambar.invlabmikro');

    Route::get('/adminlabankes/labankeskimia/databarang', [InventarisLabAnkeskimiaController::class, 'index'])->name('databarangadminlabankeskimia');
    Route::delete('/adminlabankes/labankeskimia/databarang/{id}', [InventarisLabAnkeskimiaController::class, 'destroy'])->name('hapusbarangankeskimia');
    Route::get('/adminlabankes/labankeskimia/tambahbarang', [InventarisLabAnkeskimiaController::class, 'create'])->name('tambahbarangadminlabankeskimia');
    Route::post('/adminlabankes/labankeskimia/tambahbarang', [InventarisLabAnkeskimiaController::class, 'store'])->name('tambahbarangadminlabankeskimia.store');
    Route::get('/adminlabankes/labankeskimia/ubahbarang/{id}', [InventarisLabAnkeskimiaController::class, 'edit'])->name('ubahbarangadminlabankeskimia');
    Route::post('/adminlabankes/labankeskimia/ubahbarang/{id}', [InventarisLabAnkeskimiaController::class, 'update'])->name('updatebarangadminlabankeskimia');
    Route::get('/adminlabankes/labankeskimia/riwayatbarangmasuk', [BarangMasukAnkeskimiaController::class, 'index'])->name('riwayatbarangmasukadminlabankeskimia');
    Route::get('/adminlabankes/labankeskimia/riwayatbarangkeluar', [BarangKeluarAnkeskimiaController::class, 'index'])->name('riwayatbarangkeluaradminlabankeskimia');
    Route::get('/adminlabankes/labankeskimia/barangmasuk', [BarangMasukAnkeskimiaController::class, 'tabel'])->name('barangmasukadminlabankeskimia');
    Route::get('/adminlabankes/labankeskimia/barangkeluar', [BarangKeluarAnkeskimiaController::class, 'tabel'])->name('barangkeluaradminlabankeskimia');
    Route::post('/adminlabankes/labankeskimia/barangmasuk', [BarangMasukAnkeskimiaController::class, 'store'])->name('barangmasukadminlabankeskimia.store');
    Route::post('/adminlabankes/labankeskimia/barangkeluar', [BarangKeluarAnkeskimiaController::class, 'store'])->name('barangkeluaradminlabankeskimia.store');
    Route::get('/adminlabankes/gambar/{id}', [InventarisLabAnkeskimiaController::class, 'getGambar'])->name('get.gambar.invlabankeskimia');

    Route::get('/adminlabankes/labmedis/databarang', [InventarisLabMedisController::class, 'index'])->name('databarangadminlabmedis');
    Route::delete('/adminlabankes/labmedis/databarang/{id}', [InventarisLabMedisController::class, 'destroy'])->name('hapusbarangmedis');
    Route::get('/adminlabankes/labmedis/tambahbarang', [InventarisLabMedisController::class, 'create'])->name('tambahbarangadminlabmedis');
    Route::post('/adminlabankes/labmedis/tambahbarang', [InventarisLabMedisController::class, 'store'])->name('tambahbarangadminlabmedis.store');
    Route::get('/adminlabankes/labmedis/ubahbarang/{id}', [InventarisLabMedisController::class, 'edit'])->name('ubahbarangadminlabmedis');
    Route::post('/adminlabankes/labmedis/ubahbarang/{id}', [InventarisLabMedisController::class, 'update'])->name('updatebarangadminlabmedis');
    Route::get('/adminlabankes/labmedis/riwayatbarangmasuk', [BarangMasukMedisController::class, 'index'])->name('riwayatbarangmasukadminlabmedis');
    Route::get('/adminlabankes/labmedis/riwayatbarangkeluar', [BarangKeluarMedisController::class, 'index'])->name('riwayatbarangkeluaradminlabmedis');
    Route::get('/adminlabankes/labmedis/barangmasuk', [BarangMasukMedisController::class, 'tabel'])->name('barangmasukadminlabmedis');
    Route::get('/adminlabankes/labmedis/barangkeluar', [BarangKeluarMedisController::class, 'tabel'])->name('barangkeluaradminlabmedis');
    Route::post('/adminlabankes/labmedis/barangmasuk', [BarangMasukMedisController::class, 'store'])->name('barangmasukadminlabmedis.store');
    Route::post('/adminlabankes/labmedis/barangkeluar', [BarangKeluarMedisController::class, 'store'])->name('barangkeluaradminlabmedis.store');
    Route::get('/adminlabankes/labmedis/gambar/{id}', [InventarisLabMedisController::class, 'getGambar'])->name('get.gambar.invlabmedis');

    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/adminlabankes/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppadminlabankes');
    Route::post('/adminlabankes/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name("update.picture.adminlabankes");
    Route::get('/adminlabankes/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpwadminlabankes');
    Route::post('/adminlabankes/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.adminlabankes');
});

Route::middleware(['auth', 'user.role:adminprodankes', 'revalidate'])->group(function (){
    Route::get('/adminprodiankes/dashboard',[DashboardAnkesController::class, 'index'])->name('dashboardadminprodiankes');
    Route::post('/adminprodiankes/dashboard', [DashboardAnkesController::class, 'updateNotification'])->name('update.notification.adminprodiankes');
    Route::get('/adminprodiankes/riwayat', [DashboardAnkesController::class, 'getRiwayat'])->name('reminder.adminprodiankes');
    Route::post('/adminprodiankes/dashboard', [DashboardAnkesController::class, 'update'])->name('reminder.update.adminprodiankes');

    Route::get('/adminprodiankes/databarang', [InventarisAnkesController::class, 'index'])->name('databarangadminprodiankes');
    Route::delete('/adminprodiankes/databarang/{id}', [InventarisAnkesController::class, 'destroy'])->name('hapusbarangankes');
    Route::get('/adminprodiankes/tambahbarang', [InventarisAnkesController::class, 'create'])->name('tambahbarangadminprodiankes');
    Route::post('/adminprodiankes/tambahbarang', [InventarisAnkesController::class, 'store'])->name('tambahbarangadminprodiankes.store');
    Route::get('/adminprodiankes/ubahbarang/{id}', [InventarisAnkesController::class, 'edit'])->name('ubahbarangadminprodiankes');
    Route::post('/adminprodiankes/ubahbarang/{id}', [InventarisAnkesController::class, 'update'])->name('updatebarangadminprodiankes');
    Route::get('/adminprodiankes/gambar/{id}', [InventarisAnkesController::class, 'getGambar'])->name('get.gambar.invankes');

    Route::get('/avatars/{filename}', [ProfileController::class, 'getAvatar'])->name('avatar');
    Route::get('/adminprodiankes/ubahprofilepicture',[ProfileController::class, 'EditProfilePic'])->name('ubahppadminprodiankes');
    Route::post('/adminprodiankes/ubahprofilepicture', [ProfileController::class, 'EditProfilePicture'])->name("update.picture.adminprodiankes");
    Route::get('/adminprodiankes/ubahpassword', [ProfileController::class, 'ChangePassword'])->name('ubahpwadminprodiankes');
    Route::post('/adminprodiankes/ubahpassword', [ProfileController::class, 'UpdatePassword'])->name('update.password.adminprodiankes');
    
    Route::get('/adminprodiankes/riwayatbarangmasuk', [BarangMasukAnkesController::class, 'index'])->name('riwayatbarangmasukadminprodiankes');
    Route::get('/adminprodiankes/riwayatbarangkeluar', [BarangKeluarAnkesController::class, 'index'])->name('riwayatbarangkeluaradminprodiankes');
    Route::get('/adminprodiankes/barangmasuk', [BarangMasukAnkesController::class, 'tabel'])->name('barangmasukadminprodiankes');
    Route::get('/adminprodiankes/barangkeluar', [BarangKeluarAnkesController::class, 'tabel'])->name('barangkeluaradminprodiankes');
    Route::post('/adminprodiankes/barangmasuk', [BarangMasukAnkesController::class, 'store'])->name('barangmasukadminprodiankes.store');
    Route::post('/adminprodiankes/barangkeluar', [BarangKeluarAnkesController::class, 'store'])->name('barangkeluaradminprodiankes.store');
});