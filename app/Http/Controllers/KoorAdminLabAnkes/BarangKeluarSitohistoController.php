<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabSitohisto;
use App\Models\BarangKeluarSitohisto;
use Illuminate\Support\Facades\Auth;

class BarangKeluarSitohistoController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabSitohisto::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labsitohisto.barangkeluar', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labsitohisto.barangkeluar', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labsitohisto.barangkeluar', compact('data'));
            }
        }
    }

    public function index(){
        $BarangKeluarSitohisto = BarangKeluarSitohisto::paginate(10);
        $data=InventarisLabSitohisto::all();
        // return view('rolekoorlabankes.contentkoorlab.labsitohisto.riwayatkeluar', compact('BarangKeluarSitohisto','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labsitohisto.riwayatkeluar', compact('BarangKeluarSitohisto','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labsitohisto.riwayatkeluar', compact('BarangKeluarSitohisto','data'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labsitohisto.barangkeluar');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labsitohisto.barangkeluar');
            } else{
                return view('roleadminlabankes.contentadminlab.labsitohisto.barangkeluar');
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
        $barang = InventarisLabSitohisto::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarSitohisto = new BarangKeluarSitohisto();
            $BarangKeluarSitohisto->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarSitohisto->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarSitohisto->keterangan_keluar = $request->keterangan_keluar;
            $BarangKeluarSitohisto->id_barang = $id_barang;
            $BarangKeluarSitohisto->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            // return redirect()->route('barangkeluarkoorlabSitohisto');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('barangkeluarkoorlabsitohisto');
                } else{
                    return redirect()->route('barangkeluaradminlabsitohisto');
                }
            }
        }
    }
}
