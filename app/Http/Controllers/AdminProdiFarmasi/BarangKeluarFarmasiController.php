<?php

namespace App\Http\Controllers\AdminProdiFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisFarmasi;
use App\Models\BarangKeluarFarmasi;

class BarangKeluarFarmasiController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisFarmasi::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        return view('roleadminprodifarmasi.contentadminprodi.barangkeluar', compact('data'));
    }

    public function index(){
        $barangkeluarfarmasi = BarangKeluarFarmasi::paginate(10);
        $data=InventarisFarmasi::all();
        return view('roleadminprodifarmasi.contentadminprodi.riwayatkeluar', compact('barangkeluarfarmasi','data'));
    }

    public function create(){
        return view('roleadminprodifarmasi.contentadminprodi.barangkeluar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_keluar'=>'required|integer',
            'tanggal_keluar' => 'required|date'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisFarmasi::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $barangkeluarfarmasi = new BarangKeluarFarmasi();
            $barangkeluarfarmasi->jumlah_keluar = $jumlah_keluar_baru;
            $barangkeluarfarmasi->tanggal_keluar = $request->tanggal_keluar;
            $barangkeluarfarmasi->id_barang = $id_barang;
            $barangkeluarfarmasi->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            return redirect()->route('barangkeluaradminprodifarmasi');
        }
    }
}
