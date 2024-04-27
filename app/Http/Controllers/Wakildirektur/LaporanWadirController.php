<?php

namespace App\Http\Controllers\Wakildirektur;
use App\Http\Controllers\Controller;
use App\Models\InventarisLabfarmakognosi;
use App\Models\BarangKeluarFarmakognosi;
use App\Models\BarangMasukFarmakognosi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanWadirController extends Controller
{
    public function index()
    {
        $barangfarmakognosi = InventarisLabFarmakognosi::count('id');
        $barang_masuk_farmakognosi = BarangMasukFarmakognosi::count('id');
        $barang_keluar_farmakognosi = BarangKeluarFarmakognosi::count('id');
        return view('dashboard', compact('barangfarmakognosi', 'barang_masuk_farmakognosi', 'barang_keluar_farmakognosi'));
    }

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
        $data=InventarisLabFarmakognosi::all();

        // Ambil data laporan berdasarkan filter
        if ($jenis == 'Barang Masuk') {
            $laporanMasuk = BarangMasukFarmakognosi::where('tanggal_masuk', '>=', $dari)
                ->where('tanggal_masuk', '<=', $sampai)
                ->get();
                
                $pdf = PDF::loadView('rolewadir.laporanBM', compact('laporanMasuk', 'dari', 'sampai', 'data'))->setPaper('A4', 'potrait');
                return $pdf->stream('Laporan Barang Masuk.pdf');
        } elseif ($jenis == 'Barang Keluar') {
            $laporanKeluar = BarangKeluarFarmakognosi::where('tanggal_keluar', '>=', $dari)
                ->where('tanggal_keluar', '<=', $sampai)
                ->get();

                $pdf = PDF::loadView('rolewadir.laporanBK', compact('laporanKeluar', 'dari', 'sampai', 'data'))->setPaper('A4', 'potrait');
            return $pdf->stream('Laporan Barang Keluar.pdf');
        }
    }

}