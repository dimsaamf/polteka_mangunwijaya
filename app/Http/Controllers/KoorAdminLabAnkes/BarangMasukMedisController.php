<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabMedis;
use App\Models\BarangMasukMedis;
use Illuminate\Support\Facades\Auth;

class BarangMasukMedisController extends Controller
{
    public function index(){
        $BarangMasukMedis = BarangMasukMedis::paginate(10);
        $data=InventarisLabMedis::all();
        // return view('rolekoorlabankes.contentkoorlab.labmedis.riwayatmasuk', compact('BarangMasukMedis','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmedis.riwayatmasuk', compact('BarangMasukMedis','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmedis.riwayatmasuk', compact('BarangMasukMedis','data'));
            }
        }
    }

    // public function tabel(){
    //     $data=InventarisLabMedis::all();
    //     return view('rolekoorlabankes.contentkoorlab.labmedis.barangmasuk', compact('data'));
    // }

    public function tabel(Request $request) {
        $query = $request->input('search');
        $data = InventarisLabMedis::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labmedis.barangmasuk', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmedis.barangmasuk', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmedis.barangmasuk', compact('data'));
            }
        }
    }
    

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labmedis.barangmasuk');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmedis.barangmasuk');
            } else{
                return view('roleadminlabankes.contentadminlab.labmedis.barangmasuk');
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
        $barang = InventarisLabMedis::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $BarangMasukMedis = new BarangMasukMedis();
        $BarangMasukMedis->jumlah_masuk = $jumlah_masuk_baru;
        $BarangMasukMedis->tanggal_masuk = $request->tanggal_masuk;
        $BarangMasukMedis->keterangan_masuk = $request->keterangan_masuk;
        $BarangMasukMedis->id_barang = $id_barang;
        $BarangMasukMedis->save();

        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        // return redirect()->route('barangmasukkoorlabMedis');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('barangmasukkoorlabmedis');
            } else{
                return redirect()->route('barangmasukadminlabmedis');
            }
        }
    }
}
