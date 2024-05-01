<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabMikro;
use App\Models\BarangKeluarMikro;
use Illuminate\Support\Facades\Auth;

class BarangKeluarMikroController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabMikro::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labmikro.barangkeluar', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.barangkeluar', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.barangkeluar', compact('data'));
            }
        }
    }

    public function index(){
        $BarangKeluarMikro = BarangKeluarMikro::paginate(10);
        $data=InventarisLabMikro::all();
        // return view('rolekoorlabankes.contentkoorlab.labmikro.riwayatkeluar', compact('BarangKeluarMikro','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.riwayatkeluar', compact('BarangKeluarMikro','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.riwayatkeluar', compact('BarangKeluarMikro','data'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labmikro.barangkeluar');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.barangkeluar');
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.barangkeluar');
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
        $barang = InventarisLabMikro::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarMikro = new BarangKeluarMikro();
            $BarangKeluarMikro->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarMikro->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarMikro->keterangan_keluar = $request->keterangan_keluar;
            $BarangKeluarMikro->id_barang = $id_barang;
            $BarangKeluarMikro->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            // return redirect()->route('barangkeluarkoorlabMikro');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('barangkeluarkoorlabmikro');
                } else{
                    return redirect()->route('barangkeluaradminlabmikro');
                }
            }
        }
    }
}
