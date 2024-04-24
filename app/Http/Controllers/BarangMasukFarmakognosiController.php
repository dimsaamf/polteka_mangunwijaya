<?php

namespace App\Http\Controllers;
use App\Account;

use Illuminate\Http\Request;
use App\Models\InventarisLabfarmakognosi;
use App\Models\BarangMasukFarmakognosi;

class BarangMasukFarmakognosiController extends Controller
{
    public function index(){
        $barangmasukfarmakognosi = BarangMasukFarmakognosi::paginate(10);
        $data=InventarisLabFarmakognosi::all();
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.riwayatmasuk', compact('barangmasukfarmakognosi','data'));
    }

    public function tabel(){
        $data=InventarisLabFarmakognosi::all();
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangmasuk', compact('data'));
    }

    public function create(){
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangmasuk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_masuk'=>'required|integer',
            'tanggal_masuk' => 'required|date'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisLabFarmakognosi::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $barangmasukfarmakognosi = new BarangMasukFarmakognosi();
        $barangmasukfarmakognosi->jumlah_masuk = $jumlah_masuk_baru;
        $barangmasukfarmakognosi->tanggal_masuk = $request->tanggal_masuk;
        $barangmasukfarmakognosi->id_barang = $id_barang;
        $barangmasukfarmakognosi->save();

        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        return redirect()->route('barangmasukkoorlabfarmakognosi');

    }
    
}
