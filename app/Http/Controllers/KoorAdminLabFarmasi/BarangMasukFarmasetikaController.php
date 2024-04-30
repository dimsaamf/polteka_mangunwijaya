<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabFarmasetika;
use App\Models\BarangMasukFarmasetika;
use Illuminate\Support\Facades\Auth;

class BarangMasukFarmasetikaController extends Controller
{
    public function index(){
        $barangmasukfarmasetika = BarangMasukFarmasetika::paginate(10);
        $data=InventarisLabFarmasetika::all();
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.riwayatmasuk', compact('barangmasukfarmasetika','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.riwayatmasuk', compact('barangmasukfarmasetika','data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.riwayatmasuk', compact('barangmasukfarmasetika','data'));
            }
        }
    }

    // public function tabel(){
    //     $data=InventarisLabFarmasetika::all();
    //     return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangmasuk', compact('data'));
    // }

    public function tabel(Request $request) {
        $query = $request->input('search');
        $data = InventarisLabFarmasetika::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangmasuk', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangmasuk', compact('data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.barangmasuk', compact('data'));
            }
        }
    }
    

    public function create(){
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangmasuk');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.barangmasuk');
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.barangmasuk');
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_masuk'=>'required|integer',
            'tanggal_masuk' => 'required|date',
            'keterangan_masuk' => 'required'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisLabFarmasetika::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $barangmasukfarmasetika = new BarangMasukfarmasetika();
        $barangmasukfarmasetika->jumlah_masuk = $jumlah_masuk_baru;
        $barangmasukfarmasetika->tanggal_masuk = $request->tanggal_masuk;
        $barangmasukfarmasetika->keterangan_masuk = $request->keterangan_masuk;
        $barangmasukfarmasetika->id_barang = $id_barang;
        $barangmasukfarmasetika->save();

        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        // return redirect()->route('barangmasukkoorlabfarmasetika');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('barangmasukkoorlabfarmasetika');
            } else{
                return redirect()->route('barangmasukadminlabfarmasetika');
            }
        }
    }
}
