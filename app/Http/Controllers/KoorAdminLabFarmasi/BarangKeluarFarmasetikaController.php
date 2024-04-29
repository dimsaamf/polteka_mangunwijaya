<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabFarmasetika;
use App\Models\BarangKeluarFarmasetika;
use Illuminate\Support\Facades\Auth;

class BarangKeluarFarmasetikaController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabFarmasetika::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangkeluar', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangkeluar', compact('data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.barangkeluar', compact('data'));
            }
        }
    }

    public function index(){
        $BarangKeluarFarmasetika = BarangKeluarFarmasetika::paginate(10);
        $data=InventarisLabFarmasetika::all();
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.riwayatkeluar', compact('BarangKeluarFarmasetika','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.riwayatkeluar', compact('BarangKeluarFarmasetika','data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.riwayatkeluar', compact('BarangKeluarFarmasetika','data'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangkeluar');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangkeluar');
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.barangkeluar');
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_keluar'=>'required|integer',
            'tanggal_keluar' => 'required|date'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisLabFarmasetika::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarFarmasetika = new BarangKeluarFarmasetika();
            $BarangKeluarFarmasetika->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarFarmasetika->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarFarmasetika->id_barang = $id_barang;
            $BarangKeluarFarmasetika->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            // return redirect()->route('barangkeluarkoorlabfarmasetika');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodfarmasi'){
                    return redirect()->route('barangkeluarkoorlabfarmasetika');
                } else{
                    return redirect()->route('barangkeluaradminlabfarmasetika');
                }
            }
        }
    }
}
