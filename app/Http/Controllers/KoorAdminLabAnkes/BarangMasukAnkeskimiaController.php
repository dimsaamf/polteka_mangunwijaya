<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabAnkeskimia;
use App\Models\BarangMasukAnkeskimia;
use Illuminate\Support\Facades\Auth;

class BarangMasukAnkeskimiaController extends Controller
{
    public function index(){
        $BarangMasukAnkeskimia = BarangMasukAnkeskimia::paginate(10);
        $data=InventarisLabAnkeskimia::all();
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.riwayatmasuk', compact('BarangMasukAnkeskimia','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.riwayatmasuk', compact('BarangMasukAnkeskimia','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.riwayatmasuk', compact('BarangMasukAnkeskimia','data'));
            }
        }
    }

    // public function tabel(){
    //     $data=InventarisLabAnkeskimia::all();
    //     return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangmasuk', compact('data'));
    // }

    public function tabel(Request $request) {
        $query = $request->input('search');
        $data = InventarisLabAnkeskimia::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangmasuk', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangmasuk', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.barangmasuk', compact('data'));
            }
        }
    }
    

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangmasuk');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangmasuk');
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.barangmasuk');
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
        $barang = InventarisLabAnkeskimia::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $BarangMasukAnkeskimia = new BarangMasukAnkeskimia();
        $BarangMasukAnkeskimia->jumlah_masuk = $jumlah_masuk_baru;
        $BarangMasukAnkeskimia->tanggal_masuk = $request->tanggal_masuk;
        $BarangMasukAnkeskimia->keterangan_masuk = $request->keterangan_masuk;
        $BarangMasukAnkeskimia->id_barang = $id_barang;
        $BarangMasukAnkeskimia->save();

        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        // return redirect()->route('barangmasukkoorlabankeskimia');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('barangmasukkoorlabankeskimia');
            } else{
                return redirect()->route('barangmasukadminlabankeskimia');
            }
        }
    }
}
