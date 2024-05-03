<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabKimia;
use App\Models\BarangMasukKimia;
use Illuminate\Support\Facades\Auth;

class BarangMasukKimiaController extends Controller
{
    public function index(Request $request){
        $query = $request->input('search');
        $BarangMasukKimia = BarangMasukKimia::with('inventarislabkimia')
                            ->whereHas('inventarislabkimia', function ($q) use ($query) {
                                $q->where('nama_barang', 'LIKE', '%' . $query . '%');
                            })->paginate(10);
    
        $data = InventarisLabKimia::all();
        
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labkimia.riwayatmasuk', compact('BarangMasukKimia', 'data'));
            } else {
                return view('roleadminlabfarmasi.contentadminlab.labkimia.riwayatmasuk', compact('BarangMasukKimia', 'data'));
            }
        }
    }
    

    // public function tabel(){
    //     $data=InventarisLabKimia::all();
    //     return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangmasuk', compact('data'));
    // }

    public function tabel(Request $request) {
        $query = $request->input('search');
        $data = InventarisLabKimia::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangmasuk', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangmasuk', compact('data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labkimia.barangmasuk', compact('data'));
            }
        }
    }
    

    public function create(){
        // return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangmasuk');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangmasuk');
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labkimia.barangmasuk');
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
        $barang = InventarisLabKimia::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $BarangMasukKimia = new BarangMasukKimia();
        $BarangMasukKimia->jumlah_masuk = $jumlah_masuk_baru;
        $BarangMasukKimia->tanggal_masuk = $request->tanggal_masuk;
        $BarangMasukKimia->keterangan_masuk = $request->keterangan_masuk;
        $BarangMasukKimia->id_barang = $id_barang;
        $BarangMasukKimia->save();

        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        // return redirect()->route('barangmasukkoorlabfarmasikimia');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('barangmasukkoorlabfarmasikimia');
            } else{
                return redirect()->route('barangmasukadminlabfarmasikimia');
            }
        }

    }
}
