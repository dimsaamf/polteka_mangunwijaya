<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use App\Models\InventarisLabMedis;
use App\Models\BarangMasukMedis;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BarangMasukMedisController extends Controller
{
    public function index(Request $request){
        // $BarangMasukMedis = BarangMasukMedis::paginate(10);
        // $data=InventarisLabMedis::all();
        $query = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $cek = Carbon::today();
        $hari_ini = $cek->toDateString();

        if ($start_date > $end_date) {
            alert()->error('Data Gagal Dicetak','Tanggal Akhir Melebihi Tanggal Awal.');
            return back();
        }

        if ($start_date > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Awal Melebihi Hari Ini.');
            return back();
        }

        if ( $end_date > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Akhir Melebihi Hari Ini.');
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


        $queryBuilder = BarangMasukMedis::with('inventarislabmedis')
            ->whereHas('inventarislabmedis', function ($q) use ($query) {
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

        $BarangMasukMedis = $queryBuilder->paginate(10);

        $data = InventarisLabMedis::all();
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
        $messages = [
            'jumlah_masuk.min' => 'Jumlah tidak boleh bilangan negatif.',
            'jumlah_masuk.numeric' => 'Jumlah harus berupa angka.',
            'jumlah_masuk.integer' => 'Jumlah harus berupa angka.',
        ];
        
        $request->validate([
            'jumlah_masuk' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $inventaris = InventarisLabMedis::findOrFail($request->id_barang);
                    $satuan = $inventaris->satuan;

                    if (in_array($satuan, ['pcs', 'lembar'])) {
                        if (strpos($value, '.') !== false) {
                            $fail('Jumlah masuk tidak boleh mengandung angka desimal untuk satuan pcs dan desimal');
                        }
                    }
                },
            ],
            'tanggal_masuk' => 'required|date',
            'keterangan_masuk' => 'required',
        ], $messages);

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
