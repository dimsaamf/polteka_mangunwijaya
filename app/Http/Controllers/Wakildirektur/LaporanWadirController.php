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

        // Inisialisasi variabel
        $laporanMasuk = null;
        $laporanKeluar = null;
        $dataInventaris = [
            'farmakognosi'=> InventarisLabFarmakognosi::all(),
            'farmasetika' => InventarisLabFarmasetika::all(),
            'kimia' => InventarisLabKimia::all(),
            'tekfarmasi' => InventarisLabTekfarmasi::all(),
        ];

        if ($jenis == 'Barang Masuk') {
            $laporanMasukFarmakognosi = BarangMasukFarmakognosi::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
            $laporanMasukFarmasetika = BarangMasukFarmasetika::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
            $laporanMasukKimia = BarangMasukKimia::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
            $laporanMasukTekfarmasi = BarangMasukTekfarmasi::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
        
            // Gabungkan data laporan masuk dari semua jenis lab
            $laporanMasuk = $laporanMasukFarmakognosi->merge($laporanMasukFarmasetika)
                                                    ->merge($laporanMasukKimia)
                                                    ->merge($laporanMasukTekfarmasi);
        
            $pdf = PDF::loadView('rolewadir.laporanBM', compact('laporanMasuk', 'dari', 'sampai', 'dataInventaris'))->setPaper('A4', 'portrait');
            return $pdf->stream('Laporan Barang Masuk.pdf');
        } elseif ($jenis == 'Barang Keluar') {
            $laporanKeluarFarmakognosi = BarangKeluarFarmakognosi::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
            $laporanKeluarFarmasetika = BarangKeluarFarmasetika::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
            $laporanKeluarKimia = BarangKeluarKimia::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
            $laporanKeluarTekfarmasi = BarangKeluarTekfarmasi::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
        
            // Gabungkan data laporan keluar dari semua jenis lab
            $laporanKeluar = $laporanKeluarFarmakognosi->merge($laporanKeluarFarmasetika)
                                                    ->merge($laporanKeluarKimia)
                                                    ->merge($laporanKeluarTekfarmasi);
        
            $pdf = PDF::loadView('rolewadir.laporanBK', compact('laporanKeluar', 'dari', 'sampai', 'dataInventaris'))->setPaper('A4', 'portrait');
            return $pdf->stream('Laporan Barang keluar.pdf');
        }

        // // Ambil data laporan berdasarkan filter
        // if ($jenis == 'Barang Masuk') {
        //     $laporanMasuk = BarangMasukFarmakognosi::where('tanggal_masuk', '>=', $dari)
        //         ->where('tanggal_masuk', '<=', $sampai)
        //         ->get();
                
        //         $pdf = PDF::loadView('rolewadir.laporanBM', compact('laporanMasuk', 'dari', 'sampai', 'data'))->setPaper('A4', 'potrait');
        //         return $pdf->stream('Laporan Barang Masuk.pdf');
        // } elseif ($jenis == 'Barang Keluar') {
        //     $laporanKeluar = BarangKeluarFarmakognosi::where('tanggal_keluar', '>=', $dari)
        //         ->where('tanggal_keluar', '<=', $sampai)
        //         ->get();

        //         $pdf = PDF::loadView('rolewadir.laporanBK', compact('laporanKeluar', 'dari', 'sampai', 'data'))->setPaper('A4', 'potrait');
        //     return $pdf->stream('Laporan Barang Keluar.pdf');
        // }
    }

    public function previewLaporanProdi(Request $request)
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

        // Inisialisasi variabel
        $laporanMasuk = null;
        $laporanKeluar = null;
        $data=InventarisFarmasi::all();

        // Ambil data laporan berdasarkan filter
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

}