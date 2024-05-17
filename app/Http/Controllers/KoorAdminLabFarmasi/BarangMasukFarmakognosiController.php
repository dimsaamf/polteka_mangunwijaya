<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabfarmakognosi;
use App\Models\BarangMasukFarmakognosi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BarangMasukFarmakognosiController extends Controller
{
    public function index(Request $request){
        // $BarangMasukFarmakognosi = BarangMasukFarmakognosi::paginate(10);
        // $data=InventarisLabFarmakognosi::all();

        $query = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $cek = Carbon::today();
        $hari_ini = $cek->toDateString();
    
        if ($start_date > $end_date) {
            alert()->error('Data Gagal Ditampilkan','Tanggal Akhir Melebihi Tanggal Awal.');
            return back();
        }
    
        if ($start_date > $hari_ini) {
            alert()->error('Data Gagal Ditampilkan.','Tanggal Awal Melebihi Hari Ini.');
            return back();
        }
    
        if ( $end_date > $hari_ini) {
            alert()->error('Data Gagal Ditampilkan.','Tanggal Akhir Melebihi Hari Ini.');
            return back();
        }
    
        if ($start_date && $end_date) {
            session()->put('filter_start_date', $start_date);
            session()->put('filter_end_date', $end_date);
        } else {
            // Jika tidak ada nilai filter yang diberikan, hapus nilai filter dari session
            session()->forget('filter_start_date');
            session()->forget('filter_end_date');
        }
    
    
        $queryBuilder = BarangMasukFarmakognosi::with('inventarislabfarmakognosi')
            ->whereHas('inventarislabfarmakognosi', function ($q) use ($query) {
                $q->where('nama_barang', 'LIKE', '%' . $query . '%');
            });
    
        if ($start_date && $end_date) {
            $queryBuilder->whereBetween('tanggal_masuk', [$start_date, $end_date]);
        }
    
        // Cek apakah tombol "Batal Filter" diklik
        if ($request->has('cancel_filter')) {
            // Hapus nilai filter dari session
            session()->forget('filter_start_date');
            session()->forget('filter_end_date');
        }
    
        $BarangMasukFarmakognosi = $queryBuilder->paginate(10);
    
        $data = InventarisLabFarmakognosi::all();

        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.riwayatmasuk', compact('barangmasukfarmakognosi','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.riwayatmasuk', compact('BarangMasukFarmakognosi','data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.riwayatmasuk', compact('BarangMasukFarmakognosi','data'));
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
        $messages = [
            'jumlah_masuk.min' => 'Jumlah tidak boleh bilangan negatif.',
            'jumlah_masuk.numeric' => 'Jumlah harus berupa angka.',
            'jumlah_masuk.integer' => 'Jumlah harus berupa angka.',
            'keterangan_masuk' => 'Keterangan harus diisi (contoh: pinjam lab lain)',
        ];

        $request->validate([
            'jumlah_masuk' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $inventaris = InventarisLabFarmakognosi::findOrFail($request->id_barang);
                    $satuan = $inventaris->satuan;

                    if (in_array($satuan, ['pcs', 'lembar'])) {
                        if (strpos($value, '.') !== false) {
                            $fail('Jumlah masuk tidak boleh mengandung angka desimal untuk satuan pcs dan lembar');
                        }
                    }
                },
            ],
            'tanggal_masuk' => 'required|date',
            'keterangan_masuk' => 'required',
        ], $messages);

        $id_barang = $request->id_barang;
        $barang = InventarisLabFarmakognosi::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_masuk_baru = $request->jumlah_masuk;
        $jumlah_akhir = $jumlah_awal + $jumlah_masuk_baru;
        
        $barang->jumlah = $jumlah_akhir;
        $barang->save();
        
        $BarangMasukFarmakognosi = new BarangMasukFarmakognosi();
        $BarangMasukFarmakognosi->jumlah_masuk = $jumlah_masuk_baru;
        $BarangMasukFarmakognosi->tanggal_masuk = $request->tanggal_masuk;
        $BarangMasukFarmakognosi->id_barang = $id_barang;
        $BarangMasukFarmakognosi->keterangan_masuk = $request->keterangan_masuk;
        $BarangMasukFarmakognosi->save();

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
