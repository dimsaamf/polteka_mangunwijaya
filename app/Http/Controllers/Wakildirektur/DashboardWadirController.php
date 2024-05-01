<?php

namespace App\Http\Controllers\Wakildirektur;
use App\Http\Controllers\Controller;
use App\Models\PengajuanBarangWadir;
use App\Models\InventarisFarmasi;
use App\Models\InventarisLabFarmakognosi;
use App\Models\InventarisLabFarmasetika;
use App\Models\InventarisLabKimia;
use App\Models\InventarisLabTekfarmasi;
use App\Models\BarangMasukFarmasi;
use App\Models\BarangMasukFarmakognosi;
use App\Models\BarangMasukFarmasetika;
use App\Models\BarangMasukKimia;
use App\Models\BarangMasukTekfarmasi;
use App\Models\BarangKeluarFarmasi;
use App\Models\BarangKeluarFarmakognosi;
use App\Models\BarangKeluarFarmasetika;
use App\Models\BarangKeluarKimia;
use App\Models\BarangKeluarTekfarmasi;
use Illuminate\Http\Request;

class DashboardWadirController extends Controller
{
    public function index(){

        $pengajuan = PengajuanBarangWadir::count();

        $baranglabfarmakognosi = InventarisLabFarmakognosi::count();
        $baranglabfarmasetika = InventarisLabFarmasetika::count();
        $baranglabkimia = InventarisLabKimia::count();
        $baranglabtekfarmasi = InventarisLabTekfarmasi::count();
        $barangprodifarmasi = InventarisFarmasi::count();

        $barangmasuklabfarmakognosi = BarangMasukFarmakognosi::count();
        $barangmasuklabfarmasetika = BarangMasukFarmasetika::count();
        $barangmasuklabkimia = BarangMasukKimia::count();
        $barangmasuklabtekfarmasi = BarangMasukTekfarmasi::count();
        $barangmasukprodifarmasi = BarangMasukFarmasi::count();

        $barangkeluarlabfarmakognosi = BarangKeluarFarmakognosi::count();
        $barangkeluarlabfarmasetika = BarangKeluarFarmasetika::count();
        $barangkeluarlabkimia = BarangKeluarKimia::count();
        $barangkeluarlabtekfarmasi = BarangKeluarTekfarmasi::count();
        $barangkeluarprodifarmasi = BarangKeluarFarmasi::count();

        $total_barang = $baranglabfarmakognosi +  $baranglabfarmasetika + $baranglabkimia + $baranglabtekfarmasi + $barangprodifarmasi;
        $total_masuk = $barangmasuklabfarmakognosi + $barangmasuklabfarmasetika + $barangmasuklabkimia + $barangmasuklabtekfarmasi + $barangmasukprodifarmasi;
        $total_keluar = $barangkeluarlabfarmakognosi + $barangkeluarlabfarmasetika + $barangkeluarlabkimia + $barangkeluarlabtekfarmasi + $barangkeluarprodifarmasi;

        return view('rolewadir.contentwadir.dashboard', compact('pengajuan', 'total_barang', 'total_masuk', 'total_keluar'));
    }
}
