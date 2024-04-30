<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabTekfarmasi;
use App\Models\BarangMasukTekfarmasi;
use Illuminate\Support\Facades\Auth;

class BarangMasukTekfarmasiController extends Controller
{
    public function index(){
        $BarangMasukTekfarmasi = BarangMasukTekfarmasi::paginate(10);
        $data=InventarisLabTekfarmasi::all();
        // return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.riwayatmasuk', compact('BarangMasukTekfarmasi','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.riwayatmasuk', compact('BarangMasukTekfarmasi','data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.riwayatmasuk', compact('BarangMasukTekfarmasi','data'));
            }
        }
    }

    // public function tabel(){
    //     $data=InventarisLabTekfarmasi::all();
    //     return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.barangmasuk', compact('data'));
    // }

    public function tabel(Request $request) {
        $query = $request->input('search');
        $data = InventarisLabTekfarmasi::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.barangmasuk', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.barangmasuk', compact('data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.barangmasuk', compact('data'));
            }
        }
    }
    

    public function create(){
        // return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.barangmasuk');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.barangmasuk');
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.barangmasuk');
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
        $barang = InventarisLabTekfarmasi::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $BarangMasukTekfarmasi = new BarangMasukTekfarmasi();
        $BarangMasukTekfarmasi->jumlah_masuk = $jumlah_masuk_baru;
        $BarangMasukTekfarmasi->tanggal_masuk = $request->tanggal_masuk;
        $BarangMasukKimia->keterangan_masuk = $request->keterangan_masuk;
        $BarangMasukTekfarmasi->id_barang = $id_barang;
        $BarangMasukTekfarmasi->save();

        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        // return redirect()->route('barangmasukkoorlabtekfarmasi');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('barangmasukkoorlabtekfarmasi');
            } else{
                return redirect()->route('barangmasukadminlabtekfarmasi');
            }
        }
    }
}
