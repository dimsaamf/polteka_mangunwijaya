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
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanWadirController extends Controller
{
    // public function index()
    // {
    //     $barangfarmakognosi = InventarisLabFarmakognosi::count('id');
    //     $barang_masuk_farmakognosi = BarangMasukFarmakognosi::count('id');
    //     $barang_keluar_farmakognosi = BarangKeluarFarmakognosi::count('id');
    //     $barangfarmasi = InventarisFarmasi::count('id');
    //     $barang_masuk_farmasi = BarangMasukFarmasi::count('id');
    //     $barang_keluar_farmasi = BarangKeluarFarmasi::count('id');
    //     return view('dashboard', compact('barangfarmakognosi', 'barang_masuk_farmakognosi', 'barang_keluar_farmakognosi', 'barangfarmasi', 'barang_masuk_farmasi', 'barang_keluar_farmasi'));
    // }

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
            alert()->error('Data Gagal Dicetak','Tanggal Akhir Melebihi Tanggal Awal.');
            return back();
        }

        if ($dari > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Awal Melebihi Hari Ini.');
            return back();
        }

        if ( $sampai > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Akhir Melebihi Hari Ini.');
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

        $semuaBarangMasuk = $semuaBarangMasuk->merge($BarangMasukFarmakognosi)
                                            ->merge($BarangMasukFarmasetika)
                                            ->merge($BarangMasukKimia)
                                            ->merge($BarangMasukTekfarmasi)
                                            ->merge($BarangMasukAnkeskimia)
                                            ->merge($BarangMasukMedis)
                                            ->merge($BarangMasukMikro)
                                            ->merge($BarangMasukSitohisto);
                                            
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

        $semuaBarangKeluar = $semuaBarangKeluar->merge($BarangKeluarFarmakognosi)
                                            ->merge($BarangKeluarFarmasetika)
                                            ->merge($BarangKeluarKimia)
                                            ->merge($BarangKeluarTekfarmasi)
                                            ->merge($BarangMasukAnkeskimia)
                                            ->merge($BarangMasukMedis)
                                            ->merge($BarangMasukMikro)
                                            ->merge($BarangMasukSitohisto);
                                            
        $semuaBarangKeluar = $semuaBarangKeluar->sortBy('tanggal_keluar');

        $dataInventarisFarmakognosi = InventarisLabFarmakognosi::all();
        $dataInventarisFarmasetika = InventarisLabFarmasetika::all();
        $dataInventarisKimia = InventarisLabKimia::all();
        $dataInventarisTekfarmasi = InventarisLabTekfarmasi::all();
        
        $dataInventarisAnkeskimia = InventarisLabAnkeskimia::all();
        $dataInventarisMedis = InventarisLabMedis::all();
        $dataInventarisMikro = InventarisLabMikro::all();
        $dataInventarisSitohisto = InventarisLabSitohisto::all();

        $dataInventaris = collect()
            ->merge($dataInventarisFarmakognosi)
            ->merge($dataInventarisFarmasetika)
            ->merge($dataInventarisKimia)
            ->merge($dataInventarisTekfarmasi)
            ->merge($BarangMasukAnkeskimia)
            ->merge($BarangMasukMedis)
            ->merge($BarangMasukMikro)
            ->merge($BarangMasukSitohisto);

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
            alert()->error('Data Gagal Dicetak','Tanggal Akhir Melebihi Tanggal Awal.');
            return back();
        }

        if ($dari > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Awal Melebihi Hari Ini.');
            return back();
        }

        if ( $sampai > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Akhir Melebihi Hari Ini.');
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
            default:
                alert()->error('Data Gagal Dicetak.','Laboratorium tidak valid.');
                return back();
                break;
        }

        $pdf = PDF::loadView('rolewadir.laporanDB', compact('semuaData', 'laboratorium'))->setPaper('A4', 'potrait');
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
                alert()->error('Data Gagal Dicetak.','Program Studi tidak valid.');
                return back();
                break;
        }

        $pdf = PDF::loadView('rolewadir.laporanDBProdi', compact('semuaData', 'prodi'))->setPaper('A4', 'potrait');
            return $pdf->stream('Laporan Barang Prodi.pdf');
    }
}