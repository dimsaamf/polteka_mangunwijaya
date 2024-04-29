<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabfarmakognosi;
use App\Models\BarangMasukFarmakognosi;
use Illuminate\Support\Facades\Auth;

class BarangMasukFarmakognosiController extends Controller
{
    public function index(){
        $barangmasukfarmakognosi = BarangMasukFarmakognosi::paginate(10);
        $data=InventarisLabFarmakognosi::all();
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.riwayatmasuk', compact('barangmasukfarmakognosi','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.riwayatmasuk', compact('barangmasukfarmakognosi','data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.riwayatmasuk', compact('barangmasukfarmakognosi','data'));
            }
        }
    }

    // public function tabel(){
    //     $data=InventarisLabFarmakognosi::all();
    //     return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangmasuk', compact('data'));
    // }

    public function tabel(Request $request) {
        $query = $request->input('search');
        $data = InventarisLabFarmakognosi::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangmasuk', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangmasuk', compact('data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.barangmasuk', compact('data'));
            }
        }
    }
    

    public function create(){
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangmasuk');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangmasuk');                                                                   
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.barangmasuk');                                                                   
            }
        }
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
        // return redirect()->route('barangmasukkoorlabfarmakognosi');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('barangmasukkoorlabfarmakognosi');
            } else{
                return redirect()->route('barangmasukadminlabfarmakognosi');
            }
        }

    }
    
}
