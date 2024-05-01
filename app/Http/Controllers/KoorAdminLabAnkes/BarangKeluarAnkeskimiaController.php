<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabAnkeskimia;
use App\Models\BarangKeluarAnkeskimia;
use Illuminate\Support\Facades\Auth;

class BarangKeluarAnkeskimiaController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabAnkeskimia::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangkeluar', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangkeluar', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.barangkeluar', compact('data'));
            }
        }
    }

    public function index(){
        $BarangKeluarAnkeskimia = BarangKeluarAnkeskimia::paginate(10);
        $data=InventarisLabAnkeskimia::all();
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.riwayatkeluar', compact('BarangKeluarAnkeskimia','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.riwayatkeluar', compact('BarangKeluarAnkeskimia','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.riwayatkeluar', compact('BarangKeluarAnkeskimia','data'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangkeluar');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangkeluar');
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.barangkeluar');
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
        $barang = InventarisLabAnkeskimia::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarAnkeskimia = new BarangKeluarAnkeskimia();
            $BarangKeluarAnkeskimia->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarAnkeskimia->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarAnkeskimia->keterangan_keluar = $request->keterangan_keluar;
            $BarangKeluarAnkeskimia->id_barang = $id_barang;
            $BarangKeluarAnkeskimia->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            // return redirect()->route('barangkeluarkoorlabAnkeskimia');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('barangkeluarkoorlabankeskimia');
                } else{
                    return redirect()->route('barangkeluaradminlabankeskimia');
                }
            }
        }
    }
}
