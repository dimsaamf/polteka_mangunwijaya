<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabSitohisto;
use App\Models\BarangMasukSitohisto;
use Illuminate\Support\Facades\Auth;

class BarangMasukSitohistoController extends Controller
{
    public function index(){
        $BarangMasukSitohisto = BarangMasukSitohisto::paginate(10);
        $data=InventarisLabSitohisto::all();
        // return view('rolekoorlabankes.contentkoorlab.labsitohisto.riwayatmasuk', compact('BarangMasukSitohisto','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labsitohisto.riwayatmasuk', compact('BarangMasukSitohisto','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labsitohisto.riwayatmasuk', compact('BarangMasukSitohisto','data'));
            }
        }
    }

    // public function tabel(){
    //     $data=InventarisLabSitohisto::all();
    //     return view('rolekoorlabankes.contentkoorlab.labsitohisto.barangmasuk', compact('data'));
    // }

    public function tabel(Request $request) {
        $query = $request->input('search');
        $data = InventarisLabSitohisto::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labsitohisto.barangmasuk', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labsitohisto.barangmasuk', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labsitohisto.barangmasuk', compact('data'));
            }
        }
    }
    

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labsitohisto.barangmasuk');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labsitohisto.barangmasuk');
            } else{
                return view('roleadminlabankes.contentadminlab.labsitohisto.barangmasuk');
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
        $barang = InventarisLabSitohisto::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $BarangMasukSitohisto = new BarangMasukSitohisto();
        $BarangMasukSitohisto->jumlah_masuk = $jumlah_masuk_baru;
        $BarangMasukSitohisto->tanggal_masuk = $request->tanggal_masuk;
        $BarangMasukSitohisto->keterangan_masuk = $request->keterangan_masuk;
        $BarangMasukSitohisto->id_barang = $id_barang;
        $BarangMasukSitohisto->save();

        alert()->success('Berhasil','Stok Barang Berhasil Ditambahkan.');
        // return redirect()->route('barangmasukkoorlabSitohisto');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('barangmasukkoorlabsitohisto');
            } else{
                return redirect()->route('barangmasukadminlabsitohisto');
            }
        }
    }
}
