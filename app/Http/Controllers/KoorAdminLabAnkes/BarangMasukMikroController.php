<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabMikro;
use App\Models\BarangMasukMikro;
use Illuminate\Support\Facades\Auth;

class BarangMasukMikroController extends Controller
{
    public function index(){
        $BarangMasukMikro = BarangMasukMikro::paginate(10);
        $data=InventarisLabMikro::all();
        // return view('rolekoorlabankes.contentkoorlab.labmikro.riwayatmasuk', compact('BarangMasukMikro','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.riwayatmasuk', compact('BarangMasukMikro','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.riwayatmasuk', compact('BarangMasukMikro','data'));
            }
        }
    }

    // public function tabel(){
    //     $data=InventarisLabMikro::all();
    //     return view('rolekoorlabankes.contentkoorlab.labmikro.barangmasuk', compact('data'));
    // }

    public function tabel(Request $request) {
        $query = $request->input('search');
        $data = InventarisLabMikro::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labmikro.barangmasuk', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.barangmasuk', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.barangmasuk', compact('data'));
            }
        }
    }
    

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labmikro.barangmasuk');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.barangmasuk');
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.barangmasuk');
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
        $barang = InventarisLabMikro::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $BarangMasukMikro = new BarangMasukMikro();
        $BarangMasukMikro->jumlah_masuk = $jumlah_masuk_baru;
        $BarangMasukMikro->tanggal_masuk = $request->tanggal_masuk;
        $BarangMasukMikro->keterangan_masuk = $request->keterangan_masuk;
        $BarangMasukMikro->id_barang = $id_barang;
        $BarangMasukMikro->save();

        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        // return redirect()->route('barangmasukkoorlabMikro');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('barangmasukkoorlabmikro');
            } else{
                return redirect()->route('barangmasukadminlabmikro');
            }
        }
    }
}
