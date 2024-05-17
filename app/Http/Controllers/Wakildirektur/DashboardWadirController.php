<?php

namespace App\Http\Controllers\Wakildirektur;
use App\Http\Controllers\Controller;
use App\Models\InventarisLabfarmakognosi;
use App\Models\BarangKeluarFarmakognosi;
use App\Models\BarangMasukFarmakognosi;
use App\Models\InventarisLabFarmasetika;
use App\Models\BarangKeluarFarmasetika;
use App\Models\BarangMasukFarmasetika;
use App\Models\InventarisLabKimia;
use App\Models\BarangKeluarKimia;
use App\Models\BarangMasukKimia;
use App\Models\InventarisLabTekfarmasi;
use App\Models\BarangKeluarTekfarmasi;
use App\Models\BarangMasukTekfarmasi;
use App\Models\InventarisLabAnkeskimia;
use App\Models\BarangKeluarAnkeskimia;
use App\Models\BarangMasukAnkeskimia;
use App\Models\InventarisLabMedis;
use App\Models\BarangKeluarMedis;
use App\Models\BarangMasukMedis;
use App\Models\InventarisLabMikro;
use App\Models\BarangKeluarMikro;
use App\Models\BarangMasukMikro;
use App\Models\InventarisLabSitohisto;
use App\Models\BarangKeluarSitohisto;
use App\Models\BarangMasukSitohisto;
use App\Models\InventarisFarmasi;
use App\Models\BarangKeluarFarmasi;
use App\Models\BarangMasukFarmasi;
use App\Models\InventarisAnkes;
use App\Models\BarangKeluarAnkes;
use App\Models\BarangMasukAnkes;
use App\Models\InventarisKimia;
use App\Models\BarangKeluarTekkimia;
use App\Models\BarangMasukTekkimia;
use App\Models\InventarisLabKimiaAnalisa;
use App\Models\InventarisLabKimiaFisika;
use App\Models\InventarisLabKimiaOrganik;
use App\Models\InventarisLabKimiaTerapan;
use App\Models\InventarisLabMikrobiologi;
use App\Models\InventarisLabOptekkim;
use App\Models\BarangMasukKimiaAnalisa;
use App\Models\BarangMasukKimiaFisika;
use App\Models\BarangMasukKimiaOrganik;
use App\Models\BarangMasukKimiaTerapan;
use App\Models\BarangMasukMikrobiologi;
use App\Models\BarangMasukOptekkim;
use App\Models\BarangKeluarKimiaAnalisa;
use App\Models\BarangKeluarKimiaFisika;
use App\Models\BarangKeluarKimiaOrganik;
use App\Models\BarangKeluarKimiaTerapan;
use App\Models\BarangKeluarMikrobiologi;
use App\Models\BarangKeluarOptekkim;
use App\Models\PengajuanBarangLabKimia;
use App\Models\PengajuanBarangLabFarmasi;
use App\Models\PengajuanBarangLabAnkes;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardWadirController extends Controller
{
    public function index()
    {
        $tanggal_hari_ini = Carbon::now();
        $tanggal_awal_bulan_ini = Carbon::now()->startOfMonth();
        $tanggal_akhir_hari_ini = $tanggal_hari_ini->endOfDay();

        $pengajuanFarmasi = PengajuanBarangLabFarmasi::whereBetween('tanggal', [$tanggal_awal_bulan_ini, $tanggal_akhir_hari_ini])->count();
        $pengajuanAnkes = PengajuanBarangLabAnkes::whereBetween('tanggal', [$tanggal_awal_bulan_ini, $tanggal_akhir_hari_ini])->count();
        $pengajuanKimia = PengajuanBarangLabKimia::whereBetween('tanggal', [$tanggal_awal_bulan_ini, $tanggal_akhir_hari_ini])->count();
        
        $dataInventarisFarmakognosi = InventarisLabFarmakognosi::count();
        $dataInventarisFarmasetika = InventarisLabFarmasetika::count();
        $dataInventarisLabKimia = InventarisLabKimia::count();
        $dataInventarisTekfarmasi = InventarisLabTekfarmasi::count();
        $dataInventarisAnkeskimia = InventarisLabAnkeskimia::count();
        $dataInventarisMedis = InventarisLabMedis::count();
        $dataInventarisMikro = InventarisLabMikro::count();
        $dataInventarisSitohisto = InventarisLabSitohisto::count();
        $dataInventarisKimiaAnalisa = InventarisLabKimiaAnalisa::count();
        $dataInventarisKimiaFisika = InventarisLabKimiaFisika::count();
        $dataInventarisKimiaOrganik = InventarisLabKimiaOrganik::count();
        $dataInventarisKimiaTerapan = InventarisLabKimiaTerapan::count();
        $dataInventarisMikrobiologi = InventarisLabMikrobiologi::count();
        $dataInventarisOptekkim = InventarisLabOptekkim::count();
        $dataInventarisFarmasi = InventarisFarmasi::count();
        $dataInventarisAnkes = InventarisAnkes::count();
        $dataInventarisKimia = InventarisKimia::count();

        $BarangMasukFarmakognosi = BarangMasukFarmakognosi::count();
        $BarangMasukFarmasetika = BarangMasukFarmasetika::count();
        $BarangMasukKimia = BarangMasukKimia::count();
        $BarangMasukTekfarmasi = BarangMasukTekfarmasi::count();
        $BarangMasukAnkeskimia = BarangMasukAnkeskimia::count();
        $BarangMasukMedis = BarangMasukMedis::count();
        $BarangMasukMikro = BarangMasukMikro::count();
        $BarangMasukSitohisto = BarangMasukSitohisto::count();
        $BarangMasukKimiaAnalisa = BarangMasukKimiaAnalisa::count();
        $BarangMasukKimiaFisika = BarangMasukKimiaFisika::count();
        $BarangMasukKimiaOrganik = BarangMasukKimiaOrganik::count();
        $BarangMasukKimiaTerapan = BarangMasukKimiaTerapan::count();
        $BarangMasukMikrobiologi = BarangMasukMikrobiologi::count();
        $BarangMasukOptekkim = BarangMasukOptekkim::count();
        $BarangMasukFarmasi = BarangMasukFarmasi::count();
        $BarangMasukAnkes = BarangMasukAnkes::count();
        $BarangMasukTekkimia = BarangMasukTekkimia::count();

        $BarangKeluarFarmakognosi = BarangKeluarFarmakognosi::count();
        $BarangKeluarFarmasetika = BarangKeluarFarmasetika::count();
        $BarangKeluarKimia = BarangKeluarKimia::count();
        $BarangKeluarTekfarmasi = BarangKeluarTekfarmasi::count();
        $BarangKeluarAnkeskimia = BarangKeluarAnkeskimia::count();
        $BarangKeluarMedis = BarangKeluarMedis::count();
        $BarangKeluarMikro = BarangKeluarMikro::count();
        $BarangKeluarSitohisto = BarangKeluarSitohisto::count();
        $BarangKeluarKimiaAnalisa = BarangKeluarKimiaAnalisa::count();
        $BarangKeluarKimiaFisika = BarangKeluarKimiaFisika::count();
        $BarangKeluarKimiaOrganik = BarangKeluarKimiaOrganik::count();
        $BarangKeluarKimiaTerapan = BarangKeluarKimiaTerapan::count();
        $BarangKeluarMikrobiologi = BarangKeluarMikrobiologi::count();
        $BarangKeluarOptekkim = BarangKeluarOptekkim::count();
        $BarangKeluarFarmasi = BarangKeluarFarmasi::count();
        $BarangKeluarAnkes = BarangKeluarAnkes::count();
        $BarangKeluarTekkimia = BarangKeluarTekkimia::count();
        
        $total_barang = $dataInventarisFarmakognosi 
        + $dataInventarisFarmasetika 
        + $dataInventarisLabKimia 
        + $dataInventarisTekfarmasi 
        + $dataInventarisAnkeskimia 
        + $dataInventarisMedis 
        + $dataInventarisMikro 
        + $dataInventarisSitohisto 
        + $dataInventarisKimiaAnalisa 
        + $dataInventarisKimiaFisika 
        + $dataInventarisKimiaOrganik 
        + $dataInventarisKimiaTerapan 
        + $dataInventarisMikrobiologi 
        + $dataInventarisOptekkim
        + $dataInventarisFarmasi
        + $dataInventarisAnkes 
        + $dataInventarisKimia; 

        $total_masuk = $BarangMasukFarmakognosi
        + $BarangMasukFarmasetika
        + $BarangMasukKimia
        + $BarangMasukTekfarmasi
        + $BarangMasukAnkeskimia
        + $BarangMasukMedis
        + $BarangMasukMikro
        + $BarangMasukSitohisto
        + $BarangMasukKimiaAnalisa
        + $BarangMasukKimiaFisika
        + $BarangMasukKimiaOrganik
        + $BarangMasukKimiaTerapan
        + $BarangMasukMikrobiologi
        + $BarangMasukOptekkim
        + $BarangMasukFarmasi
        + $BarangMasukAnkes
        + $BarangMasukTekkimia;


        $total_keluar =
        + $BarangMasukFarmakognosi
        + $BarangMasukFarmasetika
        + $BarangMasukKimia
        + $BarangMasukTekfarmasi
        + $BarangMasukAnkeskimia
        + $BarangMasukMedis
        + $BarangMasukMikro
        + $BarangMasukSitohisto
        + $BarangMasukKimiaAnalisa
        + $BarangMasukKimiaFisika
        + $BarangMasukKimiaOrganik
        + $BarangMasukKimiaTerapan
        + $BarangMasukMikrobiologi
        + $BarangMasukOptekkim
        + $BarangKeluarFarmasi
        + $BarangKeluarAnkes
        + $BarangKeluarTekkimia;

        $pengajuan =
        + $pengajuanFarmasi
        + $pengajuanAnkes
        + $pengajuanKimia;

        return view('rolewadir.contentwadir.dashboard', compact('pengajuan', 'total_barang', 'total_masuk', 'total_keluar'));
    }
}
