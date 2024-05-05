<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabKimia;
use App\Models\BarangKeluarKimia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BarangKeluarKimiaController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabKimia::query();
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        $data = $data->paginate(10);
        // return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangkeluar', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangkeluar', compact('data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labkimia.barangkeluar', compact('data'));
            }
        }
    }

    public function index(Request $request){
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

        $queryBuilder = BarangKeluarKimia::with('inventarislabkimia')
            ->whereHas('inventarislabkimia', function ($q) use ($query) {
                $q->where('nama_barang', 'LIKE', '%' . $query . '%');
            });

        if ($start_date && $end_date) {
            $queryBuilder->whereBetween('tanggal_keluar', [$start_date, $end_date]);
        }

        // Cek apakah tombol "Batal Filter" diklik
        if ($request->has('cancel_filter')) {
            // Hapus nilai filter dari session
            session()->forget('filter_start_date');
            session()->forget('filter_end_date');
        }

        $BarangKeluarKimia = $queryBuilder->paginate(10);

        $data = InventarisLabKimia::all();

        // return view('rolekoorlabfarmasi.contentkoorlab.labkimia.riwayatkeluar', compact('BarangKeluarKimia','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labkimia.riwayatkeluar', compact('BarangKeluarKimia','data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labkimia.riwayatkeluar', compact('BarangKeluarKimia','data'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangkeluar');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labkimia.barangkeluar');
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labkimia.barangkeluar');
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_keluar'=>'required|integer',
            'tanggal_keluar' => 'required|date',
            'keterangan_keluar' => 'required'
        ]);

        $id_barang = $request->id_barang;
        $barang = InventarisLabKimia::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarKimia = new BarangKeluarKimia();
            $BarangKeluarKimia->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarKimia->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarKimia->keterangan_keluar = $request->keterangan_keluar;
            $BarangKeluarKimia->id_barang = $id_barang;
            $BarangKeluarKimia->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            // return redirect()->route('barangkeluarkoorlabfarmasikimia');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodfarmasi'){
                    return redirect()->route('barangkeluarkoorlabfarmasikimia');
                } else{
                    return redirect()->route('barangkeluaradminlabfarmasikimia');
                }
            }
        }
    }
}
