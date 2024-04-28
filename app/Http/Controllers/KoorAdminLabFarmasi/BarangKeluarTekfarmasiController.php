<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabTekfarmasi;
use App\Models\BarangKeluarTekfarmasi;

class BarangKeluarTekfarmasiController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabTekfarmasi::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.barangkeluar', compact('data'));
    }

    public function index(){
        $BarangKeluarTekfarmasi = BarangKeluarTekfarmasi::paginate(10);
        $data=InventarisLabTekfarmasi::all();
        return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.riwayatkeluar', compact('BarangKeluarTekfarmasi','data'));
    }

    public function create(){
        return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.barangkeluar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_keluar'=>'required|integer',
            'tanggal_keluar' => 'required|date'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisLabTekfarmasi::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarTekfarmasi = new BarangKeluarTekfarmasi();
            $BarangKeluarTekfarmasi->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarTekfarmasi->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarTekfarmasi->id_barang = $id_barang;
            $BarangKeluarTekfarmasi->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            return redirect()->route('barangkeluarkoorlabtekfarmasi');
        }
    }
}
