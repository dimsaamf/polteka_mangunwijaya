<?php

namespace App\Http\Controllers;
use App\Account;

use Illuminate\Http\Request;
use App\Models\InventarisLabfarmakognosi;
use App\Models\BarangMasukFarmakognosi;

class BarangMasukFarmakognosiController extends Controller
{
    // public function index(){
    //     $barangmasukfarmakognosi = BarangMasukFarmakognosi::paginate(10);
    //     return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangmasuk', compact('barangmasukfarmakognosi'));
    // }

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

        $item=InventarisLabFarmakognosi::all();
        $barangmasukfarmakognosi = new BarangMasukFarmakognosi();
        $barangmasukfarmakognosi->jumlah_masuk = $request->jumlah_masuk;
        $barangmasukfarmakognosi->tanggal_masuk = $request->tanggal_masuk;
        
        // $barangmasukfarmakognosi->nama_barang = $item->nama_barang;
        // $barangmasukfarmakognosi->jumlah = $item->jumlah;
        // $barangmasukfarmakognosi->harga = $item->harga;
        // $barangmasukfarmakognosi->keterangan = $item->keterangan;
        

        // foreach ($jumlah_masuk as $key => $value) {
        //     if ($value == 0) {
        //         continue;
        //     }
        //     // dd($value);
        //     $dt_produk = InventarisLabFarmakognosi::where('id', $id_barang[$key])->first();
        //     InventarisLabFarmakognosi::where('id', $id_barang[$key])->update([
        //         'jumlah_masuk' => $dt_produk->jumlah_masuk[$key] + $jumlah_masuk
        //     ]);
        //     BarangMasukFarmakognosi::insert([
        //         'id_barang' => $id_barang[$key],
        //         'nama_barang' => $nama_barang[$key],
        //         'jumlah' => $jumlah[$key],
        //         'satuan' => $satuan[$key],
        //         'harga' => $harga[$key],
        //         'keterangan' => $keterangan[$key],
        //         'tanggal_masuk' => $tanggal_masuk,
        //     ]);

        // }

        $barangmasukfarmakognosi->save();
        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        return redirect()->route('barangmasukkoorlabfarmakognosi');

    }
    
}
