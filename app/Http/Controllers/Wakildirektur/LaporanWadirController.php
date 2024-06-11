<?php

namespace App\Http\Controllers\Wakildirektur;
use App\Http\Controllers\Controller;
use App\Models\InventarisLabFarmakognosi;
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
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanWadirController extends Controller
{

    public function laporanlab()
    {
        return view('rolewadir.contentwadir.laporanlab');
    }

    public function laporanprodi()
    {
        return view('rolewadir.contentwadir.laporanprodi');
    }

    public function previewLaporan(Request $request)
    {
        // Validasi input
        $request->validate([
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'jenis_laporan' => 'required'
        ]);

        // Ambil input dari request
        $dari = $request->tgl_awal;
        $sampai = $request->tgl_akhir;
        $jenis = $request->jenis_laporan;
        $cek = Carbon::today();
        $hari_ini = $cek->toDateString();

        if ($dari > $sampai) {
            alert()->error('Data Gagal Ditampilkan','Tanggal Akhir Melebihi Tanggal Awal.');
            return back();
        }

        if ($dari > $hari_ini) {
            alert()->error('Data Gagal Ditampilkan.','Tanggal Awal Melebihi Hari Ini.');
            return back();
        }

        if ( $sampai > $hari_ini) {
            alert()->error('Data Gagal Ditampilkan.','Tanggal Akhir Melebihi Hari Ini.');
            return back();
        }

        $semuaBarangMasuk = collect();

        $BarangMasukFarmakognosi = BarangMasukFarmakognosi::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukFarmasetika = BarangMasukFarmasetika::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukKimia = BarangMasukKimia::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukTekfarmasi = BarangMasukTekfarmasi::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        
        $BarangMasukAnkeskimia = BarangMasukAnkeskimia::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukMedis = BarangMasukMedis::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukMikro = BarangMasukMikro::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukSitohisto = BarangMasukSitohisto::whereBetween('tanggal_masuk', [$dari, $sampai])->get();

        $BarangMasukKimiaAnalisa = BarangMasukKimiaAnalisa::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukKimiaFisika = BarangMasukKimiaFisika::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukKimiaOrganik = BarangMasukKimiaOrganik::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukKimiaTerapan = BarangMasukKimiaTerapan::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukMikrobiologi = BarangMasukMikrobiologi::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukOptekkim = BarangMasukOptekkim::whereBetween('tanggal_masuk', [$dari, $sampai])->get();

        $semuaBarangMasuk = $semuaBarangMasuk->merge($BarangMasukFarmakognosi)
                                            ->merge($BarangMasukFarmasetika)
                                            ->merge($BarangMasukKimia)
                                            ->merge($BarangMasukTekfarmasi)
                                            ->merge($BarangMasukAnkeskimia)
                                            ->merge($BarangMasukMedis)
                                            ->merge($BarangMasukMikro)
                                            ->merge($BarangMasukSitohisto)
                                            ->merge($BarangMasukKimiaAnalisa)
                                            ->merge($BarangMasukKimiaFisika)
                                            ->merge($BarangMasukKimiaOrganik)
                                            ->merge($BarangMasukKimiaTerapan)
                                            ->merge($BarangMasukMikrobiologi)
                                            ->merge($BarangMasukOptekkim);
                                            
        $semuaBarangMasuk = $semuaBarangMasuk->sortBy('tanggal_masuk');

        $semuaBarangKeluar = collect();

        $BarangKeluarFarmakognosi = BarangKeluarFarmakognosi::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarFarmasetika = BarangKeluarFarmasetika::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarKimia = BarangKeluarKimia::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarTekfarmasi = BarangKeluarTekfarmasi::whereBetween('tanggal_keluar', [$dari, $sampai])->get();

        $BarangKeluarAnkeskimia = BarangKeluarAnkeskimia::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarMedis = BarangKeluarMedis::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarMikro = BarangKeluarMikro::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarSitohisto = BarangKeluarSitohisto::whereBetween('tanggal_keluar', [$dari, $sampai])->get();

        $BarangKeluarKimiaAnalisa = BarangKeluarKimiaAnalisa::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarKimiaFisika = BarangKeluarKimiaFisika::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarKimiaOrganik = BarangKeluarKimiaOrganik::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarKimiaTerapan = BarangKeluarKimiaTerapan::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarMikrobiologi = BarangKeluarMikrobiologi::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarOptekkim = BarangKeluarOptekkim::whereBetween('tanggal_keluar', [$dari, $sampai])->get();

        $semuaBarangKeluar = $semuaBarangKeluar->merge($BarangKeluarFarmakognosi)
                                            ->merge($BarangKeluarFarmasetika)
                                            ->merge($BarangKeluarKimia)
                                            ->merge($BarangKeluarTekfarmasi)
                                            ->merge($BarangKeluarAnkeskimia)
                                            ->merge($BarangKeluarMedis)
                                            ->merge($BarangKeluarMikro)
                                            ->merge($BarangKeluarSitohisto)
                                            ->merge($BarangKeluarKimiaAnalisa)
                                            ->merge($BarangKeluarKimiaFisika)
                                            ->merge($BarangKeluarKimiaOrganik)
                                            ->merge($BarangKeluarKimiaTerapan)
                                            ->merge($BarangKeluarMikrobiologi)
                                            ->merge($BarangKeluarOptekkim);
                                            
        $semuaBarangKeluar = $semuaBarangKeluar->sortBy('tanggal_keluar');

        $dataInventarisFarmakognosi = InventarisLabFarmakognosi::all();
        $dataInventarisFarmasetika = InventarisLabFarmasetika::all();
        $dataInventarisKimia = InventarisLabKimia::all();
        $dataInventarisTekfarmasi = InventarisLabTekfarmasi::all();
        
        $dataInventarisAnkeskimia = InventarisLabAnkeskimia::all();
        $dataInventarisMedis = InventarisLabMedis::all();
        $dataInventarisMikro = InventarisLabMikro::all();
        $dataInventarisSitohisto = InventarisLabSitohisto::all();

        $dataInventarisKimiaAnalisa = InventarisLabKimiaAnalisa::all();
        $dataInventarisKimiaFisika = InventarisLabKimiaFisika::all();
        $dataInventarisKimiaOrganik = InventarisLabKimiaOrganik::all();
        $dataInventarisKimiaTerapan = InventarisLabKimiaTerapan::all();
        $dataInventarisMikrobiologi = InventarisLabMikrobiologi::all();
        $dataInventarisOptekkim = InventarisLabOptekkim::all();

        $dataInventaris = collect()
            ->merge($dataInventarisFarmakognosi)
            ->merge($dataInventarisFarmasetika)
            ->merge($dataInventarisKimia)
            ->merge($dataInventarisTekfarmasi)
            ->merge($dataInventarisAnkeskimia)
            ->merge($dataInventarisMedis)
            ->merge($dataInventarisMikro)
            ->merge($dataInventarisSitohisto)

            ->merge($dataInventarisKimiaAnalisa)
            ->merge($dataInventarisKimiaFisika)
            ->merge($dataInventarisKimiaOrganik)
            ->merge($dataInventarisKimiaTerapan)
            ->merge($dataInventarisMikrobiologi)
            ->merge($dataInventarisOptekkim);

        if ($jenis == 'Barang Masuk') {
            foreach ($semuaBarangMasuk as $barangMasuk) {
                $inventaris = null;
                switch ($barangMasuk->getTable()) {
                    case 'barang_masuk_farmakognosis':
                        $inventaris = $dataInventarisFarmakognosi->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_farmasetikas':
                        $inventaris = $dataInventarisFarmasetika->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_kimias':
                        $inventaris = $dataInventarisKimia->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_tekfarmasis':
                        $inventaris = $dataInventarisTekfarmasi->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_ankeskimias':
                        $inventaris = $dataInventarisAnkeskimia->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_medis':
                        $inventaris = $dataInventarisMedis->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_mikros':
                        $inventaris = $dataInventarisMikro->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_sitohistos':
                        $inventaris = $dataInventarisSitohisto->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_kimia_analisas':
                        $inventaris = $dataInventarisKimiaAnalisa->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_kimia_fisikas':
                        $inventaris = $dataInventarisKimiaFisika->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_kimia_organiks':
                        $inventaris = $dataInventarisKimiaOrganik->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_kimia_terapans':
                        $inventaris = $dataInventarisKimiaTerapan->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_mikrobiologis':
                        $inventaris = $dataInventarisMikrobiologi->where('id', $barangMasuk->id_barang)->first();
                        break;
                    case 'barang_masuk_optekkims':
                        $inventaris = $dataInventarisOptekkim->where('id', $barangMasuk->id_barang)->first();
                        break;
                    default:
                        break;
                }
        
                if ($inventaris) {
                    $barangMasuk->nama_barang = $inventaris->nama_barang;
                    $barangMasuk->kode_barang = $inventaris->kode_barang;
                    $barangMasuk->satuan = $inventaris->satuan;
                }
            }
            
            $pdf = PDF::loadView('rolewadir.laporanBM', compact('semuaBarangMasuk', 'dari', 'sampai'))->setPaper('A4', 'landscape');
            return $pdf->stream('Laporan Barang Masuk.pdf');        
        } elseif ($jenis == 'Barang Keluar') {
            foreach ($semuaBarangKeluar as $barangKeluar) {
                $inventaris = null;
                switch ($barangKeluar->getTable()) {
                    case 'barang_keluar_farmakognosis':
                        $inventaris = $dataInventarisFarmakognosi->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_farmasetikas':
                        $inventaris = $dataInventarisFarmasetika->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_kimias':
                        $inventaris = $dataInventarisKimia->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_tekfarmasis':
                        $inventaris = $dataInventarisTekfarmasi->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_ankeskimias':
                        $inventaris = $dataInventarisAnkeskimia->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_medis':
                        $inventaris = $dataInventarisMedis->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_mikros':
                        $inventaris = $dataInventarisMikro->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_sitohistos':
                        $inventaris = $dataInventarisSitohisto->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_kimia_analisas':
                        $inventaris = $dataInventarisKimiaAnalisa->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_kimia_fisikas':
                        $inventaris = $dataInventarisKimiaFisika->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_kimia_organiks':
                        $inventaris = $dataInventarisKimiaOrganik->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_kimia_terapans':
                        $inventaris = $dataInventarisKimiaTerapan->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_mikrobiologis':
                        $inventaris = $dataInventarisMikrobiologi->where('id', $barangKeluar->id_barang)->first();
                        break;
                    case 'barang_keluar_optekkims':
                        $inventaris = $dataInventarisOptekkim->where('id', $barangKeluar->id_barang)->first();
                        break;
                    default:
                        break;
                }
        
                if ($inventaris) {
                    $barangKeluar->nama_barang = $inventaris->nama_barang;
                    $barangKeluar->kode_barang = $inventaris->kode_barang;
                    $barangKeluar->satuan = $inventaris->satuan;
                }
            }
        
            $pdf = PDF::loadView('rolewadir.laporanBK', compact('semuaBarangKeluar', 'dari', 'sampai'))->setPaper('A4', 'landscape');
            return $pdf->stream('Laporan Barang keluar.pdf');
        }
    }

    public function previewLaporanProdi(Request $request)
    {
        $request->validate([
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'jenis_laporan' => 'required'
        ]);

        $dari = $request->tgl_awal;
        $sampai = $request->tgl_akhir;
        $jenis = $request->jenis_laporan;
        $cek = Carbon::today();
        $hari_ini = $cek->toDateString();

        if ($dari > $sampai) {
            alert()->error('Data Gagal Ditampilkan','Tanggal Akhir Melebihi Tanggal Awal.');
            return back();
        }

        if ($dari > $hari_ini) {
            alert()->error('Data Gagal Ditampilkan.','Tanggal Awal Melebihi Hari Ini.');
            return back();
        }

        if ( $sampai > $hari_ini) {
            alert()->error('Data Gagal Ditampilkan.','Tanggal Akhir Melebihi Hari Ini.');
            return back();
        }

        $semuaBarangMasuk = collect();

        $BarangMasukFarmasi = BarangMasukFarmasi::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukAnkes = BarangMasukAnkes::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $BarangMasukTekkimia = BarangMasukTekkimia::whereBetween('tanggal_masuk', [$dari, $sampai])->get();

        $semuaBarangMasuk = $semuaBarangMasuk->merge($BarangMasukFarmasi)
                                            ->merge($BarangMasukAnkes)
                                            ->merge($BarangMasukTekkimia);
                                            
        $semuaBarangMasuk = $semuaBarangMasuk->sortBy('tanggal_masuk');

        $semuaBarangKeluar = collect();

        $BarangKeluarFarmasi = BarangKeluarFarmasi::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarAnkes = BarangKeluarAnkes::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarTekkimia = BarangKeluarTekkimia::whereBetween('tanggal_keluar', [$dari, $sampai])->get();

        $semuaBarangKeluar = $semuaBarangKeluar->merge($BarangKeluarFarmasi)
                                            ->merge($BarangKeluarAnkes)
                                            ->merge($BarangKeluarTekkimia);
                                            
        $semuaBarangKeluar = $semuaBarangKeluar->sortBy('tanggal_keluar');

        $dataInventarisFarmasi = InventarisFarmasi::all();
        $dataInventarisAnkes = InventarisAnkes::all();
        $dataInventarisKimia= InventarisKimia::all();

        $dataInventaris = collect()
            ->merge($dataInventarisFarmasi)
            ->merge($dataInventarisAnkes)
            ->merge($dataInventarisKimia);

            if ($jenis == 'Barang Masuk') {
                foreach ($semuaBarangMasuk as $barangMasuk) {
                    $inventaris = null;
                    switch ($barangMasuk->getTable()) {
                        case 'barang_masuk_farmasis':
                            $inventaris = $dataInventarisFarmasi->where('id', $barangMasuk->id_barang)->first();
                            break;
                        case 'barang_masuk_tekkimias':
                            $inventaris = $dataInventarisKimia->where('id', $barangMasuk->id_barang)->first();
                            break;
                        case 'barang_masuk_ankes':
                            $inventaris = $dataInventarisAnkes->where('id', $barangMasuk->id_barang)->first();
                            break;
                        default:
                            break;
                    }
            
                    if ($inventaris) {
                        $barangMasuk->nama_barang = $inventaris->nama_barang;
                        $barangMasuk->kode_barang = $inventaris->kode_barang;
                        $barangMasuk->satuan = $inventaris->satuan;
                    }
                }
                
                $pdf = PDF::loadView('rolewadir.laporanBMProdi', compact('semuaBarangMasuk', 'dari', 'sampai'))->setPaper('A4', 'landscape');
                return $pdf->stream('Laporan Barang Masuk.pdf');        
            } elseif ($jenis == 'Barang Keluar') {
                foreach ($semuaBarangKeluar as $barangKeluar) {
                    $inventaris = null;
                    switch ($barangKeluar->getTable()) {
                        case 'barang_keluar_farmasis':
                            $inventaris = $dataInventarisFarmasi->where('id', $barangKeluar->id_barang)->first();
                            break;
                        case 'barang_keluar_tekkimias':
                            $inventaris = $dataInventarisKimia->where('id', $barangKeluar->id_barang)->first();
                            break;
                        case 'barang_keluar_ankes':
                            $inventaris = $dataInventarisAnkes->where('id', $barangKeluar->id_barang)->first();
                            break;
                        default:
                            break;
                    }
            
                    if ($inventaris) {
                        $barangKeluar->nama_barang = $inventaris->nama_barang;
                        $barangKeluar->kode_barang = $inventaris->kode_barang;
                        $barangKeluar->satuan = $inventaris->satuan;
                    }
                }
            
                $pdf = PDF::loadView('rolewadir.laporanBKProdi', compact('semuaBarangKeluar', 'dari', 'sampai'))->setPaper('A4', 'landscape');
                return $pdf->stream('Laporan Barang Keluar.pdf');
            }
    }

    public function cetakSemuaData(Request $request)
    {
        $request->validate([
            'laboratorium' => 'required'
        ]);

        $laboratorium = $request->laboratorium;

        switch ($laboratorium) {
            case 'Farmakognosi':
                $semuaData = InventarisLabFarmakognosi::all();
                break;
            case 'Farmasetika':
                $semuaData = InventarisLabFarmasetika::all();
                break;
            case 'Kimia (Farmasi)':
                $semuaData = InventarisLabKimia::all();
                break;
            case 'Teknologi Farmasi':
                $semuaData = InventarisLabTekfarmasi::all();
                break;
            case 'Kimia (Ankes)':
                $semuaData = InventarisLabAnkeskimia::all();
                break;
            case 'Medis':
                $semuaData = InventarisLabMedis::all();
                break;
            case 'Mikro':
                $semuaData = InventarisLabMikro::all();
                break;
            case 'Sitohisto':
                $semuaData = InventarisLabSitohisto::all();
                break;
            case 'Kimia Analisa':
                $semuaData = InventarisLabKimiaAnalisa::all();
                break;
            case 'Kimia Fisika':
                $semuaData = InventarisLabKimiaFisika::all();
                break;
            case 'Kimia Organik':
                $semuaData = InventarisLabKimiaOrganik::all();
                break;
            case 'Kimia Terapan':
                $semuaData = InventarisLabKimiaTerapan::all();
                break;
            case 'Mikrobiologi':
                $semuaData = InventarisLabMikrobiologi::all();
                break;
            case 'Operasi Teknik Kimia':
                $semuaData = InventarisLabOptekkim::all();
                break;
            
            default:
                alert()->error('Data Gagal Ditampilkan.','Laboratorium tidak valid.');
                return back();
                break;
        }

        $pdf = PDF::loadView('rolewadir.laporanDB', compact('semuaData', 'laboratorium'))->setPaper('A4', 'landscape');
            return $pdf->stream('Laporan Barang Laboratorium.pdf');
    }

    public function cetakSemuaDataProdi(Request $request)
    {
        $request->validate([
            'prodi' => 'required'
        ]);

        $prodi = $request->prodi;

        switch ($prodi) {
            case 'Farmasi':
                $semuaData = InventarisFarmasi::all();
                break;
            case 'Analisis Kesehatan':
                $semuaData = InventarisAnkes::all();
                break;
            case 'Teknik Kimia':
                $semuaData = InventarisKimia::all();
                break;
            default:
                alert()->error('Data Gagal Ditampilkan.','Program Studi tidak valid.');
                return back();
                break;
        }

        $pdf = PDF::loadView('rolewadir.laporanDBProdi', compact('semuaData', 'prodi'))->setPaper('A4', 'landscape');
            return $pdf->stream('Laporan Barang Prodi.pdf');
    }
}