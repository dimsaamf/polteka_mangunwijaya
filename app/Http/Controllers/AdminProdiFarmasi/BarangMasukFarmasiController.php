<?php

namespace App\Http\Controllers\AdminProdiFarmasi;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisFarmasi;
use App\Models\BarangMasukFarmasi;

class BarangMasukFarmasiController extends Controller
{
    public function index(){
        $barangmasukfarmasi = BarangMasukFarmasi::paginate(10);
        $data=InventarisFarmasi::all();
        return view('roleadminprodifarmasi.contentadminprodi.riwayatmasuk', compact('barangmasukfarmasi','data'));
    }

    public function tabel(Request $request) {
        $query = $request->input('search');
        $data = InventarisFarmasi::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        return view('roleadminprodifarmasi.contentadminprodi.barangmasuk', compact('data'));
    }
    

    public function create(){
        return view('roleadminprodifarmasi.contentadminprodi.barangmasuk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_masuk'=>'required|integer',
            'tanggal_masuk' => 'required|date',
            'keterangan_masuk' => 'required'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisFarmasi::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $barangmasukfarmasi = new BarangMasukFarmasi();
        $barangmasukfarmasi->jumlah_masuk = $jumlah_masuk_baru;
        $barangmasukfarmasi->tanggal_masuk = $request->tanggal_masuk;
        $barangmasukfarmasi->keterangan_masuk = $request->keterangan_masuk;
        $barangmasukfarmasi->id_barang = $id_barang;
        $barangmasukfarmasi->save();

        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        return redirect()->route('barangmasukadminprodifarmasi');

    }
}
