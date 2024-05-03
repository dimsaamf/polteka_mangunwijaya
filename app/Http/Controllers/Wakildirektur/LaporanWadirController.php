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
use App\Models\InventarisFarmasi;
use App\Models\BarangKeluarFarmasi;
use App\Models\BarangMasukFarmasi;
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

        $barangMasukFarmakognosi = BarangMasukFarmakognosi::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $barangMasukFarmasetika = BarangMasukFarmasetika::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $barangMasukKimia = BarangMasukKimia::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        $barangMasukTekfarmasi = BarangMasukTekfarmasi::whereBetween('tanggal_masuk', [$dari, $sampai])->get();

        $semuaBarangMasuk = $semuaBarangMasuk->merge($barangMasukFarmakognosi)
                                            ->merge($barangMasukFarmasetika)
                                            ->merge($barangMasukKimia)
                                            ->merge($barangMasukTekfarmasi);
                                            
        $semuaBarangMasuk = $semuaBarangMasuk->sortBy('tanggal_masuk');

        $semuaBarangKeluar = collect();

        $barangKeluarFarmakognosi = BarangKeluarFarmakognosi::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $barangKeluarFarmasetika = BarangKeluarFarmasetika::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $barangKeluarKimia = BarangKeluarKimia::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        $BarangKeluarTekfarmasi = BarangKeluarTekfarmasi::whereBetween('tanggal_keluar', [$dari, $sampai])->get();

        $semuaBarangKeluar = $semuaBarangKeluar->merge($barangKeluarFarmakognosi)
                                            ->merge($barangKeluarFarmasetika)
                                            ->merge($barangKeluarKimia)
                                            ->merge($BarangKeluarTekfarmasi);
                                            
        $semuaBarangKeluar = $semuaBarangKeluar->sortBy('tanggal_keluar');

        $dataInventarisFarmakognosi = InventarisLabFarmakognosi::all();
        $dataInventarisFarmasetika = InventarisLabFarmasetika::all();
        $dataInventarisKimia = InventarisLabKimia::all();
        $dataInventarisTekfarmasi = InventarisLabTekfarmasi::all();

        $dataInventaris = collect()
            ->merge($dataInventarisFarmakognosi)
            ->merge($dataInventarisFarmasetika)
            ->merge($dataInventarisKimia)
            ->merge($dataInventarisTekfarmasi);

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

        $laporanMasuk = null;
        $laporanKeluar = null;
        $data=InventarisFarmasi::all();

        if ($jenis == 'Barang Masuk') {
            $laporanMasuk = BarangMasukFarmasi::where('tanggal_masuk', '>=', $dari)
                ->where('tanggal_masuk', '<=', $sampai)
                ->get();
                
                $pdf = PDF::loadView('rolewadir.laporanBMProdi', compact('laporanMasuk', 'dari', 'sampai', 'data'))->setPaper('A4', 'potrait');
                return $pdf->stream('Laporan Barang Masuk.pdf');
        } elseif ($jenis == 'Barang Keluar') {
            $laporanKeluar = BarangKeluarFarmasi::where('tanggal_keluar', '>=', $dari)
                ->where('tanggal_keluar', '<=', $sampai)
                ->get();

                $pdf = PDF::loadView('rolewadir.laporanBKProdi', compact('laporanKeluar', 'dari', 'sampai', 'data'))->setPaper('A4', 'potrait');
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
            case 'farmakognosi':
                $semuaData = InventarisLabFarmakognosi::all();
                break;
            case 'farmasetika':
                $semuaData = InventarisLabFarmasetika::all();
                break;
            case 'kimia':
                $semuaData = InventarisLabKimia::all();
                break;
            case 'tekfarmasi':
                $semuaData = InventarisLabTekfarmasi::all();
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
            case 'farmasi':
                $semuaData = InventarisFarmasi::all();
                break;
            case 'ankes':
                $semuaData = InventarisLabFarmasetika::all();
                break;
            case 'tekkimia':
                $semuaData = InventarisLabKimia::all();
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