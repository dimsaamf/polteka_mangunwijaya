<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabKimia;
use App\Models\BarangKeluarKimia;

class BarangKeluarKimiaController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabKimia::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangkeluar', compact('data'));
    }

    public function index(){
        $BarangKeluarKimia = BarangKeluarKimia::paginate(10);
        $data=InventarisLabKimia::all();
        return view('rolekoorlabfarmasi.contentkoorlab.labkimia.riwayatkeluar', compact('BarangKeluarKimia','data'));
    }

    public function create(){
        return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangkeluar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_keluar'=>'required|integer',
            'tanggal_keluar' => 'required|date'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisLabKimia::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarKimia = new BarangKeluarKimia();
            $BarangKeluarKimia->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarKimia->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarKimia->id_barang = $id_barang;
            $BarangKeluarKimia->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            return redirect()->route('barangkeluarkoorlabfarmasikimia');
        }
    }
}
