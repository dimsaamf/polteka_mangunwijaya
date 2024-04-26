<?php

namespace App\Http\Controllers\Wakildirektur;
use App\Http\Controllers\Controller;
use App\Models\InventarisLabfarmakognosi;
use App\Models\BarangKeluarFarmakognosi;
use App\Models\BarangMasukFarmakognosi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

    public function tampilkanLaporan(Request $request)
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

    if ($dari > $sampai || $dari > $hari_ini || $sampai > $hari_ini) {
        // Tampilkan pesan error jika validasi gagal
        alert()->error('Data Gagal Ditampilkan', 'Periksa kembali tanggal yang dimasukkan.');
        return back();
    }

    // Inisialisasi variabel
    $laporanMasuk = null;
    $laporanKeluar = null;
    $data = InventarisLabFarmakognosi::all();

    // Ambil data laporan berdasarkan filter
    if ($jenis == 'Barang Masuk') {
        $laporanMasuk = BarangMasukFarmakognosi::whereBetween('tanggal_masuk', [$dari, $sampai])->get();
    } elseif ($jenis == 'Barang Keluar') {
        $laporanKeluar = BarangKeluarFarmakognosi::whereBetween('tanggal_keluar', [$dari, $sampai])->get();
    }

    return view('rolewadir.contentwadir.laporanlab', compact('laporanMasuk', 'laporanKeluar', 'data', 'dari', 'sampai', 'jenis'));
}

public function cetakPDF(Request $request)
{
    // Ambil data yang sudah ditampilkan
    $laporanMasuk = $request->laporanMasuk;
    $laporanKeluar = $request->laporanKeluar;
    $dari = $request->dari;
    $sampai = $request->sampai;
    $jenis = $request->jenis;

    // Buat PDF berdasarkan data yang sudah ditampilkan
    if ($jenis == 'Barang Masuk') {
        $pdf = PDF::loadView('rolewadir.laporanBM', compact('laporanMasuk', 'dari', 'sampai'))->setPaper('A4', 'landscape');
        return $pdf->download('Laporan Barang Masuk.pdf');
    } elseif ($jenis == 'Barang Keluar') {
        $pdf = PDF::loadView('rolewadir.laporanBM', compact('laporanKeluar', 'dari', 'sampai'))->setPaper('A4', 'landscape');
        return $pdf->download('Laporan Barang Keluar.pdf');
    }
}

    
}
