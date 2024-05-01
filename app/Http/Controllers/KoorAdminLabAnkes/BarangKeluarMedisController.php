<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabMedis;
use App\Models\BarangKeluarMedis;
use Illuminate\Support\Facades\Auth;

class BarangKeluarMedisController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabMedis::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labmedis.barangkeluar', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmedis.barangkeluar', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmedis.barangkeluar', compact('data'));
            }
        }
    }

    public function index(){
        $BarangKeluarMedis = BarangKeluarMedis::paginate(10);
        $data=InventarisLabMedis::all();
        // return view('rolekoorlabankes.contentkoorlab.labmedis.riwayatkeluar', compact('BarangKeluarMedis','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmedis.riwayatkeluar', compact('BarangKeluarMedis','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmedis.riwayatkeluar', compact('BarangKeluarMedis','data'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labmedis.barangkeluar');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmedis.barangkeluar');
            } else{
                return view('roleadminlabankes.contentadminlab.labmedis.barangkeluar');
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_keluar'=>'required|integer',
            'tanggal_keluar' => 'required|date',
            'keterangan_keluar' => 'required'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisLabMedis::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarMedis = new BarangKeluarMedis();
            $BarangKeluarMedis->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarMedis->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarMedis->keterangan_keluar = $request->keterangan_keluar;
            $BarangKeluarMedis->id_barang = $id_barang;
            $BarangKeluarMedis->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            // return redirect()->route('barangkeluarkoorlabMedis');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('barangkeluarkoorlabmedis');
                } else{
                    return redirect()->route('barangkeluaradminlabmedis');
                }
            }
        }
    }
}
