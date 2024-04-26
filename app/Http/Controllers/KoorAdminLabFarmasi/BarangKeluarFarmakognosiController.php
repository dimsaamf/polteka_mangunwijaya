<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabfarmakognosi;
use App\Models\BarangKeluarFarmakognosi;

class BarangKeluarFarmakognosiController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabFarmakognosi::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangkeluar', compact('data'));
    }

    public function index(){
        $barangkeluarfarmakognosi = BarangKeluarFarmakognosi::paginate(10);
        $data=InventarisLabFarmakognosi::all();
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.riwayatkeluar', compact('barangkeluarfarmakognosi','data'));
    }

    public function create(){
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangkeluar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_keluar'=>'required|integer',
            'tanggal_keluar' => 'required|date'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisLabFarmakognosi::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $barangkeluarfarmakognosi = new BarangKeluarFarmakognosi();
            $barangkeluarfarmakognosi->jumlah_keluar = $jumlah_keluar_baru;
            $barangkeluarfarmakognosi->tanggal_keluar = $request->tanggal_keluar;
            $barangkeluarfarmakognosi->id_barang = $id_barang;
            $barangkeluarfarmakognosi->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            return redirect()->route('barangkeluarkoorlabfarmakognosi');
        }
    }
}
